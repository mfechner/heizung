/* Tool to read values from a modbus device and print every byte read to stdout
 *
 * To compile execute cc `pkg-config --cflags --libs libmodbus` writeModbus.c -o writeModbus
 *
 * ./writeModbus  -f 0x10 -a 0x0501 -s 0x2 -t 1 -v -w 23
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

    globalArgs.deviceName = "/dev/ttyr00";
    globalArgs.verbose = 0;
    globalArgs.type = 0;
    readParameter(argc, argv);

    printf("Data to write: %s\n", globalArgs.writeData);
    // allocate required memory to store data received from modbus device
    allocateMemory(&smallArray, &bigArray);
    convertStringToBigArray(globalArgs.writeData, globalArgs.type, bigArray);
    printf("Converted: %x\n", bigArray[0]);
    printf("Converted: %x\n", bigArray[1]);

    // open connection to the modbus device
    openModbusConnection(&ctx, &smallArray, &bigArray);

    modbus_set_slave(ctx, 1);

    switch (globalArgs.function) {
    case 1: // write single coil
        //rc = modbus_write_bit(ctx, globalArgs.address, globalArgs.size, TRUE/FALSE);
        break;
    case 2: // write a single register
        //rc = modbus_write_register(ctx, globalArgs.address, globalArgs.size, bigArray);
        break;
    case 4: // write many registers
        rc = modbus_write_registers(ctx, globalArgs.address, globalArgs.size, bigArray);
        break;
    default:
        fprintf(stderr, "No function defined, do not write anything\n");
        exit(EXIT_FAILURE);
    }

    if (rc == -1) {
        fprintf(stderr, "Write register failed %s\n", modbus_strerror(errno));
        modbus_close(ctx);
        modbus_free(ctx);
        free(smallArray);
        free(bigArray);
        exit(EXIT_FAILURE);
    }

    modbus_close(ctx);
    modbus_free(ctx);
    free(smallArray);
    free(bigArray);
    exit(EXIT_SUCCESS);
}
