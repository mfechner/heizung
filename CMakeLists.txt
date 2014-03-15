# Projectname
PROJECT(heating)

# Minimum version
CMAKE_MINIMUM_REQUIRED(VERSION 2.6)

SET(CMAKE_VERBOSE_MAKEFILE OFF)

# find modbus library
FIND_PACKAGE(PkgConfig)
PKG_CHECK_MODULES(MODBUS QUIET REQUIRED libmodbus)
INCLUDE_DIRECTORIES(${MODBUS_INCLUDE_DIRS})
SET(LIBS ${LIBS} ${MODBUS_LIBRARIES})

# Set global CFLAGS
SET(CMAKE_C_FLAGS "-Wall -g")


# execute cmake in the following directories
ADD_SUBDIRECTORY(lib)
ADD_SUBDIRECTORY(src)

# Es sollen auch einige Dateien installiert werden, z.B. Bilder oder Übersetzungen
#install(FILES img/icon.png DESTINATION img)

