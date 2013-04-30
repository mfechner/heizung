#!/usr/bin/perl
#
# Script all values from a Waterkotte WPCU.C
#
# (c) by Matthias Fechner <idefix@fechner.net>
#
use strict;
use DBI;
use Data::Dumper;
use Config::General;
use WPMemoryMapping;
use WPgeneralFunctions;

use vars qw(%wp_memory %dataTypes %config);

my $conf   = new Config::General("config");
my %config = $conf->getall;

my $dbh = DBI->connect(
	'DBI:mysql:' . $config{'database'} . ':' . $config{'server'},
	$config{'user'}, $config{'password'},
	{ RaiseError => 0, AutoCommit => 1 }
  )
  or die "Cannot connect to database" . DBI->errstr;

my $prog;
my %values;
foreach ( keys %wp_memory ) {
	$values{$_} = &readParameter( \%wp_memory, \%dataTypes, $_ );
	#print "$_=$values{$_}\n";
}

#print("Store to database\n");

my $query = &create_insert( $dbh, "wp_data", \%values );
my $sth = $dbh->prepare($query)
  or die( "Could not prepare string: " . $dbh->errstr );
$sth->execute() or die "Couldn't execute statement: " . $sth->errstr;

