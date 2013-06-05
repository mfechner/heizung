#!/usr/bin/perl
#
# Script to convert config hash to json object
#
# (c) by Matthias Fechner <idefix@fechner.net>
#
use strict;
use Data::Dumper;
use WPMemoryMapping;
use WPgeneralFunctions;
use JSON;

use vars qw(%wp_memory %dataTypes);

print encode_json(\%wp_memory);
print("\n" );

