#!/usr/bin/perl
#
# Script all values from a Waterkotte WPCU.C
#
# (c) by Matthias Fechner <idefix@fechner.net>
#
use strict;
use DBI;
use WPMemoryMapping;
use vars qw(%wp_memory %dataTypes);

my $dbh = DBI->connect('DBI:mysql:heizung:localhost', 'root', 'reset62',
                    {RaiseError => 0, AutoCommit => 1}) or die "Cannot connect to database" . DBI->errstr;

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
    print "$_=$values{$_}\n";
}

print("Store to database\n");

my $query = &create_insert($dbh, "wp_data", \%values);
my $sth = $dbh->prepare($query) or die("Could not prepare string: ". $dbh->errstr);
$sth->execute() or die "Couldn't execute statement: " . $sth->errstr;



# given a DBI object (to do quoting), the table name and a hashref of 
# field => value pairs, creates an SQL insert statement
sub create_insert {
 
    my ($dbh, $table, $data) = @_;
 
    if (!$table || ref $data ne 'HASH') {
        warn "create_insert() called wrongly";
        return;
    }
 
    my $sql = sprintf 'INSERT INTO %s (%s) VALUES (%s);',
        $table,
        join(', ', map { $dbh->quote_identifier($_) } keys   %$data),
        join(',' , map { $dbh->quote($_)            } values %$data)
    ;
 
    return $sql . "\n";
} # end of function create_insert

