CFLAGS = -c -Wall -g -I. -I../include -I /usr/local/include/modbus/
LDFLAGS = -L. -lmylib

CFLAGS += $(shell pkg-config --cflags libmodbus)
LDFLAGS += $(shell pkg-config --libs libmodbus)

mylib: mylib.o
	$(AR) rcs lib$@.a -o $<

clean:
	rm *.o
	rm *.a
	rm readModbus
	
%.o: %.c
	$(CC) $(CFLAGS) $<

