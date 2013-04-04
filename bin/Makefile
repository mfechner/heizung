CFLAGS = -c -Wall
LDFLAGS =

CFLAGS += `pkg-config --cflags libmodbus`
LDFLAGS += `pkg-config --libs libmodbus`

all: readModbus

readModbus: readModbus.o
	$(CC) $(LDFLAGS) -o $@ $< 
	
clean:
	rm *.o
	rm readModbus
	
%.o: %.c
	$(CC) $(CFLAGS) -c $<

