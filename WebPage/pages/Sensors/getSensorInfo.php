<?php
include 'globalSensorInfo.php';

$nameStrings = new ArrayObject(array());
$typeStrings = new ArrayObject(array());
$analysisStrings = new ArrayObject(array());
$peakStartStrings = new ArrayObject(array());
$peakStopStrings = new ArrayObject(array());
$minStrings = new ArrayObject(array());
$maxStrings = new ArrayObject(array());
$i2cStrings = new ArrayObject(array());
$pinStrings = new ArrayObject(array());
$binTypeStrings = new ArrayObject(array());
$fromSensorNumberStrings = new ArrayObject(array());
$fromSensorMinStrings = new ArrayObject(array());
$fromSensorMaxStrings = new ArrayObject(array());
$weekdaysStrings = new ArrayObject(array());
$customStartStrings = new ArrayObject(array());
$customStopStrings = new ArrayObject(array());
$summaryMethodStrings = new ArrayObject(array());

$nameArray = new ArrayObject(array());
$typeArray = new ArrayObject(array());
$analysisArray = new ArrayObject(array());
$peakStartArray = new ArrayObject(array());
$peakStopArray = new ArrayObject(array());
$minArray = new ArrayObject(array());
$maxArray = new ArrayObject(array());
$i2cArray = new ArrayObject(array());
$pinArray = new ArrayObject(array());
$binTypeArray = new ArrayObject(array());
$fromSensorNumberArray = new ArrayObject(array());
$fromSensorMinArray = new ArrayObject(array());
$fromSensorMaxArray = new ArrayObject(array());
$weekdaysArray = new ArrayObject(array());
$customStartArray = new ArrayObject(array());
$customStopArray = new ArrayObject(array());
$summaryMethodArray = new ArrayObject(array());

for ($i = 1; $i <= $NUM_SENSORS; $i++) {
	$nameStrings->append("name" . $i);
	$typeStrings->append("sensor" . $i . "type");
	$analysisStrings->append("analysis" . $i . "type");
	$i2cStrings->append("i2c" . $i);
	$pinStrings->append("pin" . $i);
	$peakStartStrings->append("peakStart" . $i);
	$peakStopStrings->append("peakStop" . $i);
	$binTypeStrings->append("binType" . $i);
	$fromSensorNumberStrings->append("fromSensorNumber" . $i);
	$fromSensorMinStrings->append("fromSensorMin" . $i);
	$fromSensorMaxStrings->append("fromSensorMax" . $i);
	$weekdaysStrings[] = (array("M" . $i, "T" . $i, "W" . $i, "Th" . $i, "F" . $i, "Sa" . $i, "Su" . $i));
	$customStartStrings->append("customStart" . $i);
	$customStopStrings->append("customStop" . $i);
	$summaryMethodStrings->append("summaryFormat" . $i);
}

if(isset($_GET["sensorInfo"])){
	for ($i = 1; $i <= $NUM_SENSORS; $i++) {
			$nameArray->append($_GET[$nameStrings[$i-1]]);
			$typeArray->append($_GET[$typeStrings[$i-1]]);
			$analysisArray->append($_GET[$analysisStrings[$i-1]]);
			$i2cArray->append($_GET[$i2cStrings[$i-1]]);
			$pinArray->append($_GET[$pinStrings[$i-1]]);
			$binTypeArray->append($_GET[$binTypeStrings[$i-1]]);
			$fromSensorNumberArray->append($_GET[$fromSensorNumberStrings[$i-1]]);
			$fromSensorMinArray->append($_GET[$fromSensorMinStrings[$i-1]]);
			$fromSensorMaxArray->append($_GET[$fromSensorMaxStrings[$i-1]]);
			$weekdaysArray[] = (array($_GET[$weekdaysStrings[$i-1][0]],$_GET[$weekdaysStrings[$i-1][1]],$_GET[$weekdaysStrings[$i-1][2]],$_GET[$weekdaysStrings[$i-1][3]],$_GET[$weekdaysStrings[$i-1][4]],$_GET[$weekdaysStrings[$i-1][5]],$_GET[$weekdaysStrings[$i-1][6]]));
			$customStartArray->append($_GET[$customStartStrings[$i-1]]);
			$customStopArray->append($_GET[$customStopStrings[$i-1]]);
			$summaryMethodArray->append($_GET[$summaryMethodStrings[$i-1]]);
	}

	$infoFile = fopen("sensorInfo.txt", "w");
	for ($i = 1; $i <= $NUM_SENSORS; $i++) {
		fwrite($infoFile, $nameArray[$i-1] . "\n");
		fwrite($infoFile, $typeArray[$i-1] . "\n");
		fwrite($infoFile, $analysisArray[$i-1] . "\n");
		fwrite($infoFile, $i2cArray[$i-1] . "\n");
		fwrite($infoFile, $pinArray[$i-1] . "\n");
		fwrite($infoFile, $binTypeArray[$i-1] . "\n");
		fwrite($infoFile, $fromSensorNumberArray[$i-1] . "\n");
		fwrite($infoFile, $fromSensorMinArray[$i-1] . "\n");
		fwrite($infoFile, $fromSensorMaxArray[$i-1] . "\n");
		for ($i2 = 0; $i2 < 7; $i2++) {
			fwrite($infoFile, $weekdaysArray[$i-1][$i2] . "\n");
		}
		fwrite($infoFile, $customStartArray[$i-1] . "\n");
		fwrite($infoFile, $customStopArray[$i-1] . "\n");
		fwrite($infoFile, $summaryMethodArray[$i-1] . "\n");
	}
}

?>