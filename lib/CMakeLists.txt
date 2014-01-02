# Wenn diese Bibliothek zusätzliche includes benötigt, müssen diese
# natürlich eingefügt werden.

# Hier wird definiert, welche Quellcodedateien zur Bibliothek dazugehören.
# Bei großen Projekten ist eine logische Unterteilung sinnvoll.
set(library_SRCS
    mylib.c
)

# Es wird festgelegt, dass es sich um eine gemeinsam genutzt Bibliothek
# handelt. Um eine statische Bibliothek zu bekommen, wird
# SHARED durch STATIC ersetzt.
add_library (library STATIC ${library_SRCS})

# Wenn nötig können auch Bibliotheken gegen andere gelinkt werden.
target_link_libraries(library
    ${libmodbus}
)

install(TARGETS library
        RUNTIME DESTINATION bin
        LIBRARY DESTINATION lib
	ARCHIVE DESTINATION lib
)
