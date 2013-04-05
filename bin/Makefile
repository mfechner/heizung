CFLAGS = -c -Wall
LDFLAGS =

CFLAGS += $(shell pkg-config --cflags libmodbus)
LDFLAGS += $(shell pkg-config --libs libmodbus)

all: readModbus

readModbus: readModbus.o
	$(CC) $(LDFLAGS) -o $@ $< 
	
clean:
	rm *.o
	rm readModbus
	
%.o: %.c
	$(CC) $(CFLAGS) $<

