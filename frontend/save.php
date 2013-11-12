<?php
require_once("_includes/globals.inc.php");

$json = file_get_contents("config.json");
$config = json_decode($json, TRUE);

$oldValue=$_POST['oldValue'];
$value=$_POST['value'];
$key=$_POST['id'];

$insertQuery = "INSERT INTO ".$db_setTable." (`key`, `old_value`, `new_value`) VALUES ('" . $key ."', '". $oldValue . "', '". $value . "')";

$dbh = mysql_connect($db_host, $db_user, $db_password) or die("Cannot connect to database: " . mysql_error());
mysql_select_db($db_name) or die("Cannot select database");

$result = mysql_query($insertQuery) or die("SQL error: ". mysql_errno());
mysql_close($dbh);
print $value;

function formatValues($values) {
	global $config;
	
	foreach ($values as $key => $val) {
		if(array_key_exists($key, $config) && array_key_exists("format", $config[$key]) && $config[$key]["format"]) {
			$values->$key= sprintf($config[$key]["format"], $val);
			$values->$key= sprintf("%s%s", $values->$key, $config[$key]["unit"]);
		}
	}

	if(key_exists("RTCDate", $values)) {
		$date = new DateTime($values->RTCDate);
		$values->RTCDate = $date->format('d.m.Y');
	}
	if(key_exists("RTCTime", $values)) {
		$time = new DateTime($values->RTCTime);
		$values->RTCTime = $time->format('H:i:s');
	}
	if(key_exists("FirmwareDate", $values)) {
		$firmwareDate = new DateTime($values->FirmwareDate);
		$values->FirmwareDate = $firmwareDate->format('d.m.Y');
	}
	return($values);
}
