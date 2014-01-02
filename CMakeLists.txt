# Der Projektname
project(heating)

# Minimal benötigte CMake-Version wenn z.B. bestimmte CMake-Kommandos benutzt werden
cmake_minimum_required(VERSION 2.6)

# Benötigte oder optionale Pakete. Hier können z.B. Qt4 oder Boost stehen
#find_package(SomePackage REQUIRED)
#find_package(OtherPackage OPTIONAL)

# CMake soll auch in diesen Verzeichnissen weitersuchen
add_subdirectory(lib)
add_subdirectory(src)

# Es sollen auch einige Dateien installiert werden, z.B. Bilder oder Übersetzungen
#install(FILES img/icon.png DESTINATION img)

