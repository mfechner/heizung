#!/usr/bin/perl
#
# Script to create a sql command for creation of the database
#
# (c) by Matthias Fechner <idefix@fechner.net>
#
use strict;
use Data::Dumper;
use WPMemoryMapping;

use vars qw(%wp_memory %dataTypes);
my %sqlDataTypes = (
    TYPE_FLOAT    => "FLOAT NOT NULL",
    TYPE_DATETIME => "DATETIME NOT NULL",
    TYPE_INT      => "INT NOT NULL",
    TYPE_BOOL     => "BOOLEAN NOT NULL",
    TYPE_TIME     => "TIME NOT NULL",
    TYPE_BYTE     => "TINYINT NOT NULL",
    TYPE_BITS     => "INT NOT NULL",
    TYPE_STRING   => "VARCHAR(16) NOT NULL",
    
);

print "CREATE TABLE wp_data (\n";
print "id INT NOT NULL auto_increment,\n";
print "timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,\n";

foreach(keys %wp_memory) {
    print "$_ ".$sqlDataTypes{ $wp_memory{$_}{type}}.",\n";
}
print " PRIMARY KEY (id),\n";
print " INDEX wpdata_timestamp (timestamp)\n";
print " )\n";

