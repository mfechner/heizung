#!/usr/bin/perl
#
# Script to read one specific values from a Waterkotte WPCU.C
#
# (c) by Matthias Fechner <idefix@fechner.net>
#
use strict;
use Data::Dumper;
use WPMemoryMapping;

use vars qw(%wp_memory %dataTypes);

if ( $#ARGV != 0 ) { die "Usage: $0 <attribute>\n"; }
my $attr = $ARGV[0];

my $prog = "./readModbus -f" . $wp_memory{$attr}{function} 
    . " -a" . $wp_memory{$attr}{addr}
    . " -s" . $wp_memory{$attr}{size}
    . " -t" . $dataTypes{ $wp_memory{$attr}{type} };
print ("Execute $prog\n");
open( PROG, "$prog|" );
my $output = <PROG>;
chomp($output);
close(PROG);
print(  $wp_memory{$attr}{caption} . " = " . $output
	  . $wp_memory{$attr}{unit}
	  . "\n" );

