<?php
include 'globalSensorInfo.php';

$nameStrings = new ArrayObject(array());
$typeStrings = new ArrayObject(array());
$analysisStrings = new ArrayObject(array());
$peakStartStrings = new ArrayObject(array());
$peakStopStrings = new ArrayObject(array());
$minStrings = new ArrayObject(array());
$maxStrings = new ArrayObject(array());

$nameArray = new ArrayObject(array());
$typeArray = new ArrayObject(array());
$analysisArray = new ArrayObject(array());
$peakStartArray = new ArrayObject(array());
$peakStopArray = new ArrayObject(array());
$minArray = new ArrayObject(array());
$maxArray = new ArrayObject(array());


for ($i = 1; $i <= $NUM_SENSORS; $i++) {
	$nameStrings->append("name" . $i);
	$typeStrings->append("sensor" . $i . "type");
	$analysisStrings->append("analysis" . $i . "type");
	$peakStartStrings->append("peakStart" . $i);
	$peakStopStrings->append("peakStop" . $i);
	$minStrings->append("min" . $i);
	$maxStrings->append("max" . $i);
}

if(isset($_GET["sensorInfo"])){
	for ($i = 1; $i <= $NUM_SENSORS; $i++) {
			$nameArray->append($_GET[$nameStrings[$i-1]]);
			$typeArray->append($_GET[$typeStrings[$i-1]]);
			$analysisArray->append($_GET[$analysisStrings[$i-1]]);
			$peakStartArray->append($_GET[$peakStartStrings[$i-1]]);
			$peakStopArray->append($_GET[$peakStopStrings[$i-1]]);
			$minArray->append($_GET[$minStrings[$i-1]]);
			$maxArray->append($_GET[$maxStrings[$i-1]]);
	}

	$infoFile = fopen("sensorInfo.txt", "w");
	for ($i = 1; $i <= $NUM_SENSORS; $i++) {
		fwrite($infoFile, $nameArray[$i-1] . "\n");
		fwrite($infoFile, $typeArray[$i-1] . "\n");
		fwrite($infoFile, $analysisArray[$i-1] . "\n");
		fwrite($infoFile, $peakStartArray[$i-1] . "\n");
		fwrite($infoFile, $peakStopArray[$i-1] . "\n");
		fwrite($infoFile, $minArray[$i-1] . "\n");
		fwrite($infoFile, $maxArray[$i-1] . "\n");
	}
}

?>