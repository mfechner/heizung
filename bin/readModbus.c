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

#include <mylib.h>
struct globalArgs_t globalArgs;

int main(int argc, char **argv) {
    modbus_t *ctx;
    uint8_t *smallArray;
    uint16_t *bigArray;
    int rc;
    int i;
    char output[40];

    globalArgs.deviceName = "/dev/ttyr00";
    globalArgs.verbose = 0;
    globalArgs.type = 0;
    readParameter(argc, argv);

    // allocate required memory to store data received from modbus device
    allocateMemory(&smallArray, &bigArray);
    // open connection to the modbus device
    openModbusConnection(&ctx, &smallArray, &bigArray);

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
        exit(EXIT_FAILURE);
    }

    if (rc == -1) {
        fprintf(stderr, "Read register failed %s\n", modbus_strerror(errno));
        modbus_close(ctx);
        modbus_free(ctx);
        free(smallArray);
        free(bigArray);
        exit(EXIT_FAILURE);
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
    free(smallArray);
    free(bigArray);
    exit(EXIT_SUCCESS);
}
