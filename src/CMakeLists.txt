# include header files
INCLUDE_DIRECTORIES( ${CMAKE_SOURCE_DIR}/include )

# add valgrind support
SET( CTEST_MEMORYCHECK_COMMAND valgrind )
SET( CTEST_MEMORYCHECK_COMMAND_OPTIONS "--tool=memcheck --leak-check=yes --show-reachable=yes --num-callers=20 --track-fds=yes -v" )
INCLUDE(CTest)
ENABLE_TESTING()
ADD_TEST(HEAP ./readModbus -f 3 -a 0x01B1 -s 0x2 -t 1)

# define source files
SET(readModbus_SRCS
    readModbus.c
)
SET(writeModbus_SRCS
    writeModbus.c
)

# define executables
ADD_EXECUTABLE(readModbus ${readModbus_SRCS})
ADD_EXECUTABLE(writeModbus ${writeModbus_SRCS})

# link library against executeables
TARGET_LINK_LIBRARIES(readModbus mylib modbus)
TARGET_LINK_LIBRARIES(writeModbus mylib modbus)

# folders to install
INSTALL(TARGETS readModbus
        RUNTIME DESTINATION bin
        LIBRARY DESTINATION lib
)
INSTALL(TARGETS writeModbus
        RUNTIME DESTINATION bin
        LIBRARY DESTINATION lib
)
