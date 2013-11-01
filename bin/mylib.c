#ifndef MYLIB_C
#define MYLIB_C

#include <unistd.h>
#include <stdlib.h>
#include <stdio.h>
#include "mylib.h"

static const char *optString = "d:f:a:s:ht:v";
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
        case 'h':
        case '?':
            if(optopt == 's' || optopt == 'a' || optopt == 'f') {
                fprintf(stderr, "Missing argument\n");
                exit(EXIT_FAILURE);
            }
            displayUsage();
            exit(EXIT_FAILURE);
        }
    }
}

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

#endif
