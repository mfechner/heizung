CFLAGS = -c -Wall -g -I.
LDFLAGS = -L. -lmylib

CFLAGS += $(shell pkg-config --cflags libmodbus)
LDFLAGS += $(shell pkg-config --libs libmodbus)

all: readModbus writeModbus

mylib: mylib.o
	$(AR) rcs lib$@.a -o $<

readModbus: readModbus.o mylib
	$(CC) -o $@ $< $(LDFLAGS) 
	
writeModbus: writeModbus.o mylib
	$(CC) -o $@ $< $(LDFLAGS) 

valgrind: readModbus writeModbus
	valgrind --tool=memcheck --leak-check=yes --show-reachable=yes --num-callers=20 --track-fds=yes ./readModbus -- -f 3 -a 0x01B1 -s
	
clean:
	rm *.o
	rm *.a
	rm readModbus
	
%.o: %.c
	$(CC) $(CFLAGS) $<

