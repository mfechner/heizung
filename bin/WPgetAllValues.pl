#!/usr/bin/perl
#
# Script all values from a Waterkotte WPCU.C
#
# (c) by Matthias Fechner <idefix@fechner.net>
#
use strict;
use Data::Dumper;
use WPMemoryMapping;
use vars qw(%wp_memory %dataTypes);

my $prog;
my %values;
foreach(keys %wp_memory) {
    $prog = "./readModbus -f" . $wp_memory{$_}{function} 
        . " -a" . $wp_memory{$_}{addr}
        . " -s" . $wp_memory{$_}{size}
        . " -t" . $dataTypes{ $wp_memory{$_}{type} };
    open( PROG, "$prog|" );
    $values{$_}=<PROG>;
    chomp($values{$_});
    close(PROG);
}

foreach(keys %values) {
	print $_ . ": " . $wp_memory{$_}{caption} . " = " . $values{$_} . $wp_memory{$_}{unit} . "\n";
}
