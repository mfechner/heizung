<?php
require_once("_includes/globals.inc.php");

$json = file_get_contents("config.json");
$config = json_decode($json, TRUE);

$queryStart = "SELECT timestamp";
$overviewQuery = " ,FirmwareVersion
                   ,FirmwareDate
                   ,OperatingState
                   ,OutdoorTemp
                   ,OutdoorTemp1h
                   ,OutdoorTemp24h
                   ,CoolReturnTempNominal
                   ,CoolReturnTemp
                   ,HeatReturnTempNominal
                   ,HeatReturnTemp
                   ,FlowTemp
                   ,DomesticWaterTempNominal
                   ,DomesticWaterTempActual
                   ,RoomTemp
                   ,RoomTemp1h
                   ,RoomTempNominal
                   ,HeatSourceIn
                   ,HeatSourceOut
                   ,EvaporationTemp
                   ,EvaporationPress
    			   ,CondensationTemp
                   ,CondensationPress
    		       ,SunctionGasTemp
                   ,RTCTime
                   ,RTCDate
                   ,OHCompressor1
                   ,PoolTempNominal
                   ,PoolTempActual
                   ,SolarTempActual
                   ,SolarTempNominalMin
                   ,HeatingCircuitNominal
                   ,HeatingCircuitTemp
                   ,DOBuffer
                   ,DIBuffer
                   ,Pelectric
                   ,Pthermal
                   ,COP
    ";
    
$heatingQuery = " ,HeatOff
				,HeatTimeOn
				,HeatTimeOff
				,HeatCharacteristicSetPoint
				,HeatCharacteristicSetPointBaseTemp
				,HeatCharacteristicGradient
				,HeatCharacteristicLimit
				,HeatReturnTemp
				,HeatReturnTempNominal
				,HeatTempHyst
				,RoomTempNominal
				,RoomTempFactor
				,HeatIncreaseOff
				,HeatIncreaseTimeOn
				,HeatIncreaseTimeOff
				,HeatIncreaseSetPtOffset
				,AuxilaryModeHeating
				,AuxilaryMaxDifference
    ";

$coolingQuery = " ,CoolOff
                ,CoolTimeOn
                ,CoolTimeOff
                ,CoolCharacteristicSetPoint
                ,CoolReturnTemp
                ,CoolReturnTempNominal
                ,CoolReturnTempHyst
    ";

$hotwaterQuery = ",DomesticWaterOff
				,DomesticWaterTimeOn
				,DomesticWaterTimeOff
				,DomesticWaterTempActual
				,DomesticWaterTempNominal
				,DomesticWaterTempHyst
				,LegionellaSchedule
				,LegionellaTimeOn
				,LegionellaTimeOff
				,LegionellaTempNominal
				,DWNumberOfCompressors
				,DomesticWaterTimeDelayOnSolar
    ";
$queryEnd = "    FROM ".$db_getTable;

switch ($_REQUEST['action']) {
	case 'overview.php':
		$values = getDbRecord($queryStart.$overviewQuery.$queryEnd);
		break;
	case 'heating.php':
		$values = getDbRecord($queryStart.$heatingQuery.$queryEnd);
		break;
	case 'cooling.php':
	    $values = getDbRecord($queryStart.$coolingQuery.$queryEnd);
	    break;
	case 'hotwater.php':
		$values = getDbRecord($queryStart.$hotwaterQuery.$queryEnd);
		break;
	case 'index.php':
	    $values = getDbRecord($queryStart.$overviewQuery.$heatingQuery.$coolingQuery.$hotwaterQuery.$queryEnd);
	    break;
	default:
	    
}
$values = formatValues($values);
echo json_encode($values);

function getDbRecord($query) {
	global $db_host, $db_user, $db_password, $db_name;
	// sometimes tsp is newer than db_entry which causes an empty result set
	// so give it a chance otherwise take the newest entry
	if(key_exists('START', $_REQUEST) && $_REQUEST['START'] > 0) {
		$restriction = " WHERE timestamp < '".$_REQUEST['START']."' ORDER BY id DESC LIMIT 1";
	} else {
		$restriction = " ORDER BY id DESC LIMIT 1";
	}
	
	$dbh = mysql_connect($db_host, $db_user, $db_password) or die("Cannot connect to database: " . mysql_error());
	mysql_select_db($db_name) or die("Cannot select database");
	
	$result = mysql_query($query.$restriction) or die("SQL error: ". mysql_errno());
	$values = mysql_fetch_object($result);
	mysql_close($dbh);
	
	return $values;
}

function formatValues($values) {
	global $config;
	
	foreach ($values as $key => $val) {
		if(array_key_exists($key, $config) && array_key_exists("format", $config[$key]) && $config[$key]["format"]) {
			$values->$key= sprintf($config[$key]["format"], $val);
			$values->$key= sprintf("%s%s", $values->$key, $config[$key]["unit"]);
		}
		if(array_key_exists($key, $config) && array_key_exists("type", $config[$key]) && $config[$key]["type"]=="TYPE_TIME") {
		    $values->$key=substr($values->$key,0 ,5);
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
