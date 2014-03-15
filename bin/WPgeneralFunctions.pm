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
    print($prog."\n");
    open( PROG, "$prog|" ) || die("Cannot execute $prog\n");
    die("readModbus failed with exit code $?\n") if($? != 0);    
    $value=<PROG>;
    chomp($value);
    close(PROG);
	
    return $value;
}

sub writeParameter() {
    my ($wp_memory, $dataTypes, $parameterKey, $value) = @_;

    # rename keys to small letters as doctrine enforces us to use to capital letters
    foreach my $key (keys %wp_memory) {
    	$wp_memory{lc($key)}=delete $wp_memory{$key};
    }
    my $prog = "./writeModbus -f" . $wp_memory->{$parameterKey}->{function}
        . " -a" . $wp_memory->{$parameterKey}{addr}
        . " -s" . $wp_memory->{$parameterKey}{size}
        . " -t" . $dataTypes->{$wp_memory->{$parameterKey}{type}}
        . " -w" . &formatValue($value);
    print($prog."\n");
    open( PROG, "$prog|" ) || die("Cannot execute $prog\n");
    die("writeModbus failed with exit code $?\n") if($? != 0);
    my $value=<PROG>;
    chomp($value);
    print("Got: $value\n");
    close(PROG);
    
    return $value;
}

sub formatValue() {
	my ($value) = @_;
	$value =~ s/[°CK]//g;
	return $value;
}
return 1;
