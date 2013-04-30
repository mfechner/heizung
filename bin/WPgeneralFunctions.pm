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

sub readParameter() {
	my ($wp_memory, $dataTypes, $parameterKey) = @_;
	my $value;
	my $prog = "./readModbus -f" . $wp_memory->{$parameterKey}->{function} 
        . " -a" . $wp_memory->{$parameterKey}{addr}
        . " -s" . $wp_memory->{$parameterKey}{size}
        . " -t" . $dataTypes->{ $wp_memory->{$parameterKey}{type} };
    open( PROG, "$prog|" ) || die("Cannot execute $prog\n");
    die("readModbus failed with exit code $?\n") if($? != 0);    
    $value=<PROG>;
    chomp($value);
    close(PROG);
	
    return $value;
}

return 1;
