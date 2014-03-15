CFLAGS = -c -Wall -g -I. -I../include 
LDFLAGS = -L. -lmylib

CFLAGS += $(shell pkg-config --cflags libmodbus)
LDFLAGS += $(shell pkg-config --libs libmodbus)

mylib: mylib.o
	$(AR) rcs lib$@.a $<

clean:
	rm *.o
	rm *.a
	
%.o: %.c
	$(CC) $(CFLAGS) $<

