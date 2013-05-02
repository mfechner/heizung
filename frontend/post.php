<?php
require_once("_includes/globals.inc.php");

$query = "SELECT timestamp,
    			   FirmwareVersion,
                   FirmwareDate,
                   OperatingState,
                   OutdoorTemp,
                   OutdoorTemp1h,
                   OutdoorTemp24h,
                   CoolReturnTempNominal,
                   CoolReturnTemp,
                   HeatReturnTempNominal,
                   HeatReturnTemp,
                   FlowTemp,
                   DomesticWaterTempNominal,
                   DomesticWaterTempActual,
                   RoomTemp,
                   RoomTemp1h,
                   RoomTempNominal,
                   HeatSourceIn,
                   HeatSourceOut,
                   EvaporationTemp,
                   EvaporationPress,
    			   CondensationTemp,
                   CondensationPress,
    		       SunctionGasTemp,
                   RTCTime,
                   RTCDate,
                   OHCompressor1,
                   PoolTempNominal,
                   PoolTempActual,
                   SolarTempActual,
                   SolarTempNominalMin,
                   HeatingCircuitNominal,
                   HeatingCircuitTemp,
                   DOBuffer,
                   DIBuffer,
                   Pelectric,
                   Pthermal,
                   COP
    FROM ".$db_getTable;

// sometimes tsp is newer than db_entry which causes an empty result set
// so give it a chance otherwise take the newest entry
if(key_exists('START', $_REQUEST)) {
    $restriction = " WHERE timestamp > '".$_REQUEST['START']."' ORDER BY id ASC LIMIT 1";
} else {
    $restriction = " ORDER BY id DESC LIMIT 1";
}

$dbh = mysql_connect($db_host, $db_user, $db_password) or die("Cannot connect to database: " . mysql_error());
mysql_select_db($db_name) or die("Cannot select database");

$result = mysql_query($query.$restriction) or die("SQL error: ". mysql_errno());
$values = mysql_fetch_object($result);

$values->OutdoorTemp = round($values->OutdoorTemp, 2)."°C";
$values->OutdoorTemp1h = round($values->OutdoorTemp1h, 2)."°C";
$values->OutdoorTemp24h = round($values->OutdoorTemp24h, 2)."°C";
$values->RoomTemp = round($values->RoomTemp, 2)."°C";
$values->RoomTemp1h = round($values->RoomTemp1h, 2)."°C";
$values->RoomTempNominal = round($values->RoomTempNominal, 2)."°C";
$values->HeatSourceIn = round($values->HeatSourceIn, 2)."°C";
$values->HeatSourceOut = round($values->HeatSourceOut, 2)."°C";
$values->SunctionGasTemp = round($values->SunctionGasTemp, 2)."°C";
$values->OHCompressor1 = round($values->OHCompressor1, 2)."h";
$values->CondensationTemp = round($values->CondensationTemp, 2)."°C";
$values->CondensationPress = round($values->CondensationPress, 2)."bar";
$values->EvaporationTemp = round($values->EvaporationTemp, 2)."°C";
$values->EvaporationPress = round($values->EvaporationPress, 2)."bar";
$values->FlowTemp = round($values->FlowTemp, 2)."°C";

$values->CoolReturnTempNominal = round($values->CoolReturnTempNominal, 2)."°C";
$values->CoolReturnTemp = round($values->CoolReturnTemp, 2)."°C";
$values->HeatReturnTempNominal = round($values->HeatReturnTempNominal, 2)."°C";
$values->DomesticWaterTempNominal = round($values->DomesticWaterTempNominal, 2)."°C";
$values->DomesticWaterTempActual = round($values->DomesticWaterTempActual, 2)."°C";
$values->PoolTempNominal = round($values->PoolTempNominal, 2)."°C";
$values->PoolTempActual = round($values->PoolTempActual, 2)."°C";
$values->SolarTempNominalMin = round($values->SolarTempNominalMin, 2)."°C";
$values->SolarTempActual = round($values->SolarTempActual, 2)."°C";
$values->HeatingCircuitNominal = round($values->HeatingCircuitNominal, 2)."°C";
$values->HeatingCircuitTemp = round($values->HeatingCircuitTemp, 2)."°C";

$values->HeatReturnTemp = round($values->HeatReturnTemp, 2)."°C";
$values->OHCompressor1 = round($values->OHCompressor1, 2)."h";
$date = new DateTime($values->RTCDate);
$values->RTCDate = $date->format('d.m.Y');
$time = new DateTime($values->RTCTime);
$values->RTCTime = $time->format('H:i:s');
$firmwareDate = new DateTime($values->FirmwareDate);
$values->FirmwareDate = $firmwareDate->format('d.m.Y');
$values->Pelectric=$values->Pelectric."kW";
$values->Pthermal=$values->Pthermal."kW";
echo json_encode($values);
