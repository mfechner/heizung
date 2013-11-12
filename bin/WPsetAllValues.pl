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

my $dbh =
  DBI->connect( 'DBI:mysql:' . $config{'database'} . ':' . $config{'server'},
	$config{'user'}, $config{'password'}, { RaiseError => 0, AutoCommit => 1 } )
  or die "Cannot connect to database" . DBI->errstr;

# get values from database to write to heating
my $query        = "SELECT * from wp_write_data where status='pending';";
my $selectResult = $dbh->prepare($query)
  or die( "Could not prepare string: " . $dbh->errstr );
$selectResult->execute() or die "Couldn't execute statement: " . $selectResult->errstr;

while ( my $hash_ref = $selectResult->fetchrow_hashref ) {
	#print "Write $hash_ref->{new_value} to $hash_ref->{key}\n";
    # write value to heating
    &writeParameter( \%wp_memory, \%dataTypes, $hash_ref->{key}, $hash_ref->{new_value});
    
    # mark record as written
    my $updateQuery="UPDATE wp_write_data SET status = 'success' WHERE id = '".$hash_ref->{id}."'";
    $dbh->do($updateQuery) or die $dbh->errstr;
}

$dbh->disconnect;
