#ifndef _MYLIB_H_
#define _MYLIB_H_

#ifdef _MYLIB_C
#define MYLIB_EXT
#else
#define MYLIB_EXT extern
#endif

#include <stdio.h>
#include <errno.h>
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
};

MYLIB_EXT void readParameter(int argc, char **argv);
MYLIB_EXT void displayUsage(char **argv);
MYLIB_EXT void allocateMemory(uint8_t **smallArray, uint16_t **bigArray);
MYLIB_EXT void openModbusConnection(modbus_t **ctx, uint8_t **smallArray, uint16_t **bigArray);
MYLIB_EXT int convertBigArrayToString(char *returnValue, int type, uint16_t *value);
MYLIB_EXT int convertSmallArrayToString(char *returnValue, int type, uint8_t *value);

#endif
