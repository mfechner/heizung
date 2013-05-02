#!/usr/bin/perl
#
# Script to read one specific values from a Waterkotte WPCU.C
#
# (c) by Matthias Fechner <idefix@fechner.net>
#
use strict;
use Data::Dumper;
use WPMemoryMapping;
use WPgeneralFunctions;

use vars qw(%wp_memory %dataTypes);

if ( $#ARGV != 0 ) { die "Usage: $0 <attribute>\n"; }
my $attr = $ARGV[0];

my $output = &readParameter(\%wp_memory, \%dataTypes, $attr);

print(  $wp_memory{$attr}{caption} . " = " . $output
	  . $wp_memory{$attr}{unit}
	  . "\n" );

