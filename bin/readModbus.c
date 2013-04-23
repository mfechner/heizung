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
#include <string.h>

enum types { FLOAT=1, DATETIME, INT , BOOL, TIME, BYTE, BITS, STRING};
struct globalArgs_t {
    char *deviceName;
    int function;
    int address;
    int size;
    int verbose;
    enum types type;
} globalArgs;
const int MAX_SIZE=16;
const int OUTPUT_MAX_SIZE=40;

static const char *optString = "d:f:a:s:ht:v";

void displayUsage() {
    printf("readModus by Matthias Fechner\n");
    printf("Usage: readModbus [-d device] [-f function] [-a address] [-s size] [-t type] [-v]\n\n");
    printf("  d : Device to open, default /dev/ttyr0\n");
    printf("  f : Function: 0x01: read coil status, 0x02: read input status, 0x03: read holding registers, 0x04: read input registers\n");
    printf("  a : Address to read\n");
    printf("  s : Size in bytes to read\n");
    printf("  t : Type of data 1=float, 2=datetime, 3=int, 4=bool, 5=time, 6=byte, 7=bits, 8=string\n");
    printf("  v : Verbose mode\n");
    printf("\n");
    printf("./readModbus -f 3 -a 0x01B1 -s 0x2 -t 1\n");
    printf("\n");
}

int convertBigArrayToString(char *returnValue, int type, uint16_t value[MAX_SIZE]) {
    switch(type) {
    case FLOAT:
        if(globalArgs.verbose) printf("Found FLOAT\n");
        int total;
        float real;
        total=((value[1] << 16) + value[0]);
        real=*((float*)&total);

        snprintf(returnValue, OUTPUT_MAX_SIZE, "%f", real);
        return 0;
    case DATETIME:
        if(globalArgs.verbose) printf("Found DATETIME\n");
        snprintf(returnValue, OUTPUT_MAX_SIZE, "%04d-%02d-%02d %02d:%02d:%02d", value[5]+1900, value[4]+1, value[3], value[2], value[1], value[0]);
        return 0;
    case INT:
        if(globalArgs.verbose) printf("Found INT\n");
        snprintf(returnValue, OUTPUT_MAX_SIZE, "%d", value[0]);
        return 0;
    case TIME:
        if(globalArgs.verbose) printf("Found TIME\n");
        snprintf(returnValue, OUTPUT_MAX_SIZE, "%02d:%02d", value[0]>>8, value[0]&0xF);
        return 0;
    case BYTE:
        if(globalArgs.verbose) printf("Found Byte\n");
        snprintf(returnValue, OUTPUT_MAX_SIZE, "%d", value[0]&0xFF);
        return 0;
    case STRING:
        if(globalArgs.verbose) printf("Found String\n");
        int i;
        char tempString[2];
        for (i=0; i<globalArgs.size; i++) {
            snprintf(tempString, 2, "%c", value[i]&0xFF);
            strcat(returnValue, tempString);
            snprintf(tempString, 2, "%c", value[i]>>8);
            strcat(returnValue, tempString);
        }
        return 0;
    }

    return -1;
}

int convertSmallArrayToString(char *returnValue, int type, uint8_t value[MAX_SIZE]) {
    switch(type) {
    case BOOL:
        if(globalArgs.verbose) printf("Found BOOL\n");
        snprintf(returnValue, OUTPUT_MAX_SIZE, "%d", value[0]);
        return 0;
    case BITS:
        if(globalArgs.verbose) printf("Found Bits\n");
        char tempString[2];
        int i;

        for (i=0; i<globalArgs.size; i++) {
            snprintf(tempString, 2, "%d", value[i]);
            strcat(returnValue, tempString);
        }

        return 0;
    }
    return -1;
}

int main(int argc, char **argv) {
    modbus_t *ctx;
    uint8_t smallArray[MAX_SIZE];
    uint16_t bigArray[MAX_SIZE];
    int rc;
    int i;
    int opt;
    char output[40];

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
            if(globalArgs.verbose) printf("reg[%d]=%d (0x%X)\n", i, smallArray[i], smallArray[i]);
        }
        convertSmallArrayToString(output, globalArgs.type, smallArray);
        printf("%s\n", output);

    } else {
        for (i = 0; i < rc; i++) {
            if(globalArgs.verbose) printf("reg[%d]=%d (0x%X)\n", i, bigArray[i], bigArray[i]);
        }
        convertBigArrayToString(output, globalArgs.type, bigArray);
        printf("%s\n", output);
    }

    modbus_close(ctx);
    modbus_free(ctx);
    return 0;
}
