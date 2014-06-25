DIRECTORIES = lib src

all:
	@for i in $(DIRECTORIES); do $(MAKE) -C $$i; done
	$(MAKE) -C src install

clean:
	@for i in $(DIRECTORIES); do $(MAKE) -C $$i clean; done

