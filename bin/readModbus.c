/* Tool to read values from a modbus device and print every byte read to stdout
 *
 * To compile execute cc `pkg-config --cflags --libs libmodbus` readModbus.c -o readModbus
 *
 * @param d Device to open, default /dev/ttyr00
 * @param f globalArgs.function (0x01: read coil status, 0x02: read input status, 0x03: read holding registers, 0x04: read input registers
 * @param a globalArgs.address to read
 * @param s globalArgs.size to read in bytes
 * (c) 2013 Matthias Fechner <idefix@fechner.net>
 */

#include <stdio.h>
#include <errno.h>
#include <unistd.h>
#include <stdlib.h>
#include <modbus.h>

struct globalArgs_t {
    char *deviceName;
    int function;
    int address;
    int size;
    int verbose;
    int type;
} globalArgs;
const int MAX_SIZE=16;
const int TYPE_FLOAT=1;

static const char *optString = "d:f:a:s:ht:v";

void displayUsage() {

}

int main(int argc, char **argv) {
    modbus_t *ctx;
    uint8_t smallArray[MAX_SIZE];
    uint16_t bigArray[MAX_SIZE];
    int rc;
    int i;
    int opt;

    globalArgs.deviceName = "/dev/ttyr00";
    globalArgs.verbose = 0;
    globalArgs.type = 0;

    while ((opt = getopt(argc, argv, optString)) != -1) {
        switch (opt) {
            case 'd':
                globalArgs.deviceName = optarg;
                break;
            case 'f':
                globalArgs.function = (int) strtol(optarg, NULL, 0);
                break;
            case 'a':
                globalArgs.address = (int) strtol(optarg, NULL, 0);
                break;
            case 's':
                globalArgs.size = (int) strtol(optarg, NULL, 0);
                break;
            case 'v':
                globalArgs.verbose = 1;
                break;
            case 't':
                globalArgs.type = (int) strtol(optarg, NULL, 0);
                break;
            case 'h':
            case '?':
                if(optopt == 's' || optopt == 'a' || optopt == 'f') {
                    fprintf(stderr, "Missing argument\n");
                    return -1;
                }
                displayUsage();
                return 1;
        }
    }
    if(globalArgs.size > MAX_SIZE) {
        fprintf(stderr, "Can only read %d bytes", MAX_SIZE);
        return -1;
    }

    ctx = modbus_new_rtu(globalArgs.deviceName, 9600, 'N', 8, 1);
    if (ctx == NULL) {
        fprintf(stderr, "Unable to create the libmodbus context\n");
        return -1;
    }
    if (globalArgs.verbose)
        modbus_set_debug(ctx, 1);

    if (modbus_connect(ctx) == -1) {
        fprintf(stderr, "Connection failed: %s\n", modbus_strerror(errno));
        modbus_free(ctx);
        return -1;
    }

    modbus_set_slave(ctx, 1);

    switch (globalArgs.function) {
        case 0:
            rc = modbus_report_slave_id(ctx, smallArray);
            break;
        case 1:
            rc = modbus_read_bits(ctx, globalArgs.address, globalArgs.size, smallArray);
            break;
        case 2:
            rc = modbus_read_input_bits(ctx, globalArgs.address, globalArgs.size, smallArray);
            break;
        case 3:
            rc = modbus_read_registers(ctx, globalArgs.address, globalArgs.size, bigArray);
            break;
        case 4:
            rc = modbus_read_input_registers(ctx, globalArgs.address, globalArgs.size, bigArray);
            break;
        default:
            fprintf(stderr, "No function defined, do not read anything\n");
    }

    if (rc == -1) {
        fprintf(stderr, "Read register failed %s\n", modbus_strerror(errno));
        modbus_close(ctx);
        modbus_free(ctx);
        return -1;
    }

    if (globalArgs.function == 0 || globalArgs.function == 1 || globalArgs.function == 2) {
        for (i = 0; i < rc; i++) {
            printf("reg[%d]=%d (0x%X)\n", i, smallArray[i], smallArray[i]);
        }
        if(globalArgs.type==1){
            printf("value: %f", (float)(smallArray[1] << 16 | smallArray[0]));
        }

    } else {
        for (i = 0; i < rc; i++) {
            printf("reg[%d]=%d (0x%X)\n", i, bigArray[i], bigArray[i]);
        }
        if (globalArgs.type == TYPE_FLOAT) {
            int total;
            float real;
            total=((bigArray[1] << 16) + bigArray[0]);
            real=*((float*)&total);
            printf("value: %f\n", real);
        }

    }

    modbus_close(ctx);
    modbus_free(ctx);
    return 0;
}
