# include header files
INCLUDE_DIRECTORIES( ${CMAKE_SOURCE_DIR}/include )

# Define source codes
set(library_SRCS
    mylib.c
)

# Compile as static library
add_library(mylib STATIC ${library_SRCS})

TARGET_LINK_LIBRARIES(mylib
    ${MODBUS_LIBRARIES}
)

install(TARGETS mylib
        RUNTIME DESTINATION bin
        LIBRARY DESTINATION lib
        ARCHIVE DESTINATION lib
)
