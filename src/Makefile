CFLAGS = -c -Wall -g -I. -I../include
LDFLAGS = -L. -lmylib -L../lib

CFLAGS += $(shell pkg-config --cflags libmodbus)
LDFLAGS += $(shell pkg-config --libs libmodbus)

all: readModbus writeModbus

readModbus: readModbus.o
	$(CC) -o $@ $< $(LDFLAGS) 
	
writeModbus: writeModbus.o
	$(CC) -o $@ $< $(LDFLAGS) 

valgrind: readModbus writeModbus
	valgrind --tool=memcheck --leak-check=yes --show-reachable=yes --num-callers=20 --track-fds=yes ./readModbus -- -f 3 -a 0x01B1 -s

json:
	perl configToJSON.pl >../frontend/module/Heating/data/config.json
	perl captionToGettext.pl >../frontend/module/Heating/data/captions.pm
	
install:
	install -C -m0755 readModbus ../bin/
	install -C -m0755 writeModbus ../bin/

clean:
	rm -f *.o
	rm -f *.a
	rm -f readModbus writeModbus
	
%.o: %.c
	$(CC) $(CFLAGS) $<

