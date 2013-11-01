#ifndef _MYLIB_H_
#define _MYLIB_H_

#ifdef _MYLIB_C
#define MYLIB_EXT
#else
#define MYLIB_EXT extern
#endif

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
MYLIB_EXT void displayUsage(void);

#endif
