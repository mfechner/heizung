#ifndef MYLIB_C
#define MYLIB_C

#include <unistd.h>
#include <stdlib.h>
#include <stdio.h>
#include "mylib.h"

static const char *optString = "d:f:a:s:ht:vw:";
extern struct globalArgs_t globalArgs;

void readParameter(int argc, char **argv) {
    int opt;

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
        case 'w':
            globalArgs.writeData = optarg;
            break;
        case 'h':
        case '?':
            if(optopt == 's' || optopt == 'a' || optopt == 'f') {
                fprintf(stderr, "Missing argument\n");
                exit(EXIT_FAILURE);
            }
            displayUsage(argv);
            exit(EXIT_FAILURE);
        }
    }
}

void displayUsage(char **argv) {
    printf("%s by Matthias Fechner\n", argv[0]);
    printf("Usage: readModbus [-d device] [-f function] [-a address] [-s size] [-t type] [-v] [-w data to write]\n\n");
    printf("  d : Device to open, default /dev/ttyr0\n");
    printf("  f : Function: 0x01: read coil status, 0x02: read input status, 0x03: read holding registers, 0x04: read input registers\n");
    printf("  a : Address to read\n");
    printf("  s : Size in bytes to read\n");
    printf("  t : Type of data 1=float, 2=datetime, 3=int, 4=bool, 5=time, 6=byte, 7=bits, 8=string\n");
    printf("  v : Verbose mode\n");
    printf("\n");
    printf("./readModbus -f 3 -a 0x01B1 -s 0x2 -t 1\n");
    printf("./writeModbus  -f 0x10 -a 0x0501 -s 0x2 -t 1 -v -w 23\n");
    printf("\n");
}

void allocateMemory(uint8_t **smallArray, uint16_t **bigArray) {

    if (globalArgs.verbose) {
        printf("Allocate %ld bytes to hold data\n", (20 * sizeof(**smallArray)  + 1) +(20 * sizeof(**bigArray) +1));
    }
    *smallArray = (uint8_t *) malloc(sizeof(**smallArray) * 20 + 1);
    if(smallArray == NULL) {
        fprintf(stderr, "Cannot reserve memory to store bytes received\n");
        exit(EXIT_FAILURE);
    }
    *bigArray = (uint16_t *) malloc(sizeof(**bigArray) * 20 + 1);
    if(bigArray == NULL) {
        fprintf(stderr, "Cannot reserve memory to store bytes recieved\n");
        free(*smallArray);
        exit(EXIT_FAILURE);
    }
}

void openModbusConnection(modbus_t **ctx, uint8_t **smallArray, uint16_t **bigArray) {
    *ctx = modbus_new_rtu(globalArgs.deviceName, 9600, 'N', 8, 1);
    if (ctx == NULL) {
        fprintf(stderr, "Unable to create the libmodbus context\n");
        free(*smallArray);
        free(*bigArray);
        exit(EXIT_FAILURE);
    }
    if (globalArgs.verbose)
        modbus_set_debug(*ctx, 1);

    if (modbus_connect(*ctx) == -1) {
        fprintf(stderr, "Connection failed: %s\n", modbus_strerror(errno));
        modbus_free(*ctx);
        free(*smallArray);
        free(*bigArray);
        exit(EXIT_FAILURE);
    }
}

int convertBigArrayToString(char *returnValue, int type, uint16_t *value) {
    switch(type) {
    case FLOAT:
        if(globalArgs.verbose) printf("Found FLOAT\n");
        int total;
        float real;
        total=((value[1] << 16) + value[0]);
        real=*((float*)&total);

        snprintf(returnValue, 20, "%f", real);
        return 0;
    case DATETIME:
        if(globalArgs.verbose) printf("Found DATETIME\n");
        snprintf(returnValue, 20, "%04d-%02d-%02d %02d:%02d:%02d", value[5]+1900, value[4]+1, value[3], value[2], value[1], value[0]);
        return 0;
    case INT:
        if(globalArgs.verbose) printf("Found INT\n");
        snprintf(returnValue, 20, "%d", value[0]);
        return 0;
    case TIME:
        if(globalArgs.verbose) printf("Found TIME\n");
        snprintf(returnValue, 6, "%02d:%02d", value[0]>>8, value[0]&0xFF);
        return 0;
    case BYTE:
        if(globalArgs.verbose) printf("Found Byte\n");
        snprintf(returnValue, 2, "%d", value[0]&0xFF);
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

int convertStringToBigArray(char *string, int type, uint16_t *returnValue) {
    switch(type) {
        case FLOAT:
            if(globalArgs.verbose) printf("Found FLOAT\n");
            float value=atof(string);
            printf("Float: %4.8f\n", value);

            unsigned int ui;
            memcpy(&ui, &value, sizeof(ui));
            printf("Hex is: 0x%X\n", ui);
            returnValue[0]=ui & 0x0000FFFF;
            printf("Hex: 0x%X", returnValue[0]);
            returnValue[1]=ui >> 16;
            printf(" %X\n", returnValue[1]);
            returnValue[2]="\0";

            return 0;
        case TIME:
            if(globalArgs.verbose) printf("Found TIME\n");
            char *part;
            uint8_t highByte, lowByte, i=1;

            part = strtok(string, ":");
            while(part != NULL) {
                if(i==1) {
                    i--;
                    highByte=atoi(part);
                } else{
                    lowByte=atoi(part);
                }
                part = strtok(NULL, ":");
            }
            *returnValue = (highByte << 8) | (lowByte &0xFF);
            return 0;
    }
    return -1;
}

int convertSmallArrayToString(char *returnValue, int type, uint8_t *value) {
    switch(type) {
    case BOOL:
        if(globalArgs.verbose) printf("Found BOOL\n");
        snprintf(returnValue, 20, "%d", value[0]);
        return 0;
    case BITS:
        if(globalArgs.verbose) printf("Found Bits\n");
        int i;
        uint16_t bitValue=0;

        for (i=0;i<globalArgs.size; i++) {
            bitValue |= ((uint16_t)value[i] << i);
        }
        snprintf(returnValue, 8, "%d", bitValue);

        return 0;
    }
    return -1;
}

int convertStringToSmallArray(char *string, int type, uint8_t *returnValue) {
    return 0;
}

#endif
