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

# rename keys to small letters as doctrine enforces us to use to capital letters
foreach my $key (keys %wp_memory) {
	$wp_memory{lc($key)}=delete $wp_memory{$key};
}
print encode_json(\%wp_memory);
print("\n" );

