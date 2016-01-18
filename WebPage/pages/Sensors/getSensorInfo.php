<?php
include 'globalSensorInfo.php';

$nameStrings = new ArrayObject(array());
$typeStrings = new ArrayObject(array());
$i2cStrings = new ArrayObject(array());
$pinStrings = new ArrayObject(array());
$numberOfAnalysisStrings = new ArrayObject(array());
$wattageStrings = new ArrayObject(array());
$analysisStrings = new ArrayObject(array());
$minStrings = new ArrayObject(array());
$maxStrings = new ArrayObject(array());
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
$i2cArray = new ArrayObject(array());
$pinArray = new ArrayObject(array());
$numberOfAnalysisArray = new ArrayObject(array());
$wattageArray = new ArrayObject(array());
$analysisArray = new ArrayObject(array());
$minArray = new ArrayObject(array());
$maxArray = new ArrayObject(array());
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
	$i2cStrings->append("i2c" . $i);
	$pinStrings->append("pin" . $i);
	$numberOfAnalysisStrings->append("numberOfAnalysis" . $i);
	$wattageStrings->append("wattage" . $i);
	$analysisStrings->append(array("","",""));
	$minStrings->append(array("", "", ""));
	$maxStrings->append(array("", "", ""));
	$binTypeStrings->append(array("", "", ""));
	$fromSensorNumberStrings->append(array("", "", ""));
	$fromSensorMinStrings->append(array("", "", ""));
	$fromSensorMaxStrings->append(array("", "", ""));
	$weekdaysStrings->append(array(array(), array(), array()));
	$customStartStrings->append(array("", "", ""));
	$customStopStrings->append(array("", "", ""));
	$summaryMethodStrings->append(array("", "", ""));
	for ($i4 = 0; $i4 < 3; $i4 ++){
		$analysisStrings[$i-1][$i4] = ("analysis" . ($i4+1) . $i . "type");
		$minStrings[$i-1][$i4] = ("min" . ($i4+1) . $i);
		$maxStrings[$i-1][$i4] = ("max" . ($i4+1) . $i);
		$binTypeStrings[$i-1][$i4] = ("binType" . ($i4+1) . $i);
		$fromSensorNumberStrings[$i-1][$i4] = ("fromSensorNumber" . ($i4+1) . $i);
		$fromSensorMinStrings[$i-1][$i4] = ("fromSensorMin" . ($i4+1) . $i);
		$fromSensorMaxStrings[$i-1][$i4] = ("fromSensorMax" . ($i4+1) . $i);
		$weekdaysStrings[$i-1][$i4] = (array("M" . ($i4+1) . $i, "T" . ($i4+1) . $i, "W" . ($i4+1) . $i, "Th" . ($i4+1) . $i, "F" . ($i4+1) . $i, "Sa" . ($i4+1) . $i, "Su" . ($i4+1) . $i));
		$customStartStrings[$i-1][$i4] = ("customStart" . ($i4+1) . $i);
		$customStopStrings[$i-1][$i4] = ("customStop" . ($i4+1) . $i);
		$summaryMethodStrings[$i-1][$i4] = ("summaryFormat" . ($i4+1) . $i);	
	}
}

if(isset($_GET["sensorInfo"])){
	for ($i = 1; $i <= $NUM_SENSORS; $i++) {
		$nameArray->append($_GET[$nameStrings[$i-1]]);
		$typeArray->append($_GET[$typeStrings[$i-1]]);
		$i2cArray->append($_GET[$i2cStrings[$i-1]]);
		$pinArray->append($_GET[$pinStrings[$i-1]]);
		$numberOfAnalysisArray->append($_GET[$numberOfAnalysisStrings[$i-1]]);
		$wattageArray->append($_GET[$wattageStrings[$i-1]]);
		$analysisStrings->append(array("","",""));
		$minArray->append(array("", "", ""));
		$maxArray->append(array("", "", ""));
		$binTypeArray->append(array("", "", ""));
		$fromSensorNumberArray->append(array("", "", ""));
		$fromSensorMinArray->append(array("", "", ""));
		$fromSensorMaxArray->append(array("", "", ""));
		$weekdaysArray->append(array(array(), array(), array()));
		$customStartArray->append(array("", "", ""));
		$customStopArray->append(array("", "", ""));
		$summaryMethodArray->append(array("", "", ""));
		for ($i4 = 0; $i4 < 3; $i4 ++){
			for ($i4 = 0; $i4 < 3; $i4++) {
				$analysisArray[$i-1][$i4] = ($_GET[$analysisStrings[$i-1][$i4]]);
				// print $analysisArray[$i-1][$i4];
				// print "LOOK HERE";
				$minArray[$i-1][$i4] = ($_GET[$minStrings[$i-1][$i4]]);
				$maxArray[$i-1][$i4] = ($_GET[$maxStrings[$i-1][$i4]]);
				$binTypeArray[$i-1][$i4] = ($_GET[$binTypeStrings[$i-1][$i4]]);
				$fromSensorNumberArray[$i-1][$i4] = ($_GET[$fromSensorNumberStrings[$i-1][$i4]]);
				$fromSensorMinArray[$i-1][$i4] = ($_GET[$fromSensorMinStrings[$i-1][$i4]]);
				$fromSensorMaxArray[$i-1][$i4] = ($_GET[$fromSensorMaxStrings[$i-1][$i4]]);
				$weekdaysArray[$i-1][$i4] = (array($_GET[$weekdaysStrings[$i-1][$i4][0]],$_GET[$weekdaysStrings[$i-1][$i4][1]],$_GET[$weekdaysStrings[$i-1][$i4][2]],$_GET[$weekdaysStrings[$i-1][$i4][3]],$_GET[$weekdaysStrings[$i-1][$i4][4]],$_GET[$weekdaysStrings[$i-1][$i4][5]],$_GET[$weekdaysStrings[$i-1][$i4][6]]));
				$customStartArray[$i-1][$i4] = ($_GET[$customStartStrings[$i-1][$i4]]);
				$customStopArray[$i-1][$i4] = ($_GET[$customStopStrings[$i-1][$i4]]);
				$summaryMethodArray[$i-1][$i4] = ($_GET[$summaryMethodStrings[$i-1][$i4]]);
			}
		}
	}

	$infoFile = fopen("sensorInfo.txt", "w");
	for ($i = 1; $i <= $NUM_SENSORS; $i++) {
		fwrite($infoFile, $nameArray[$i-1] . "\n");
		fwrite($infoFile, $typeArray[$i-1] . "\n");
		fwrite($infoFile, $i2cArray[$i-1] . "\n");
		fwrite($infoFile, $pinArray[$i-1] . "\n");
		fwrite($infoFile, $numberOfAnalysisArray[$i-1] . "\n");
		fwrite($infoFile, $wattageArray[$i-1] . "\n");
		for ($i4 = 0; $i4 < 3; $i4++) {
			fwrite($infoFile, $analysisArray[$i-1][$i4] . "\n");
			// print ($i-1);
			fwrite($infoFile, $minArray[$i-1][$i4] . "\n");
			fwrite($infoFile, $maxArray[$i-1][$i4] . "\n");
			fwrite($infoFile, $binTypeArray[$i-1][$i4] . "\n");
			fwrite($infoFile, $fromSensorNumberArray[$i-1][$i4] . "\n");
			fwrite($infoFile, $fromSensorMinArray[$i-1][$i4] . "\n");
			fwrite($infoFile, $fromSensorMaxArray[$i-1][$i4] . "\n");
			for ($i2 = 0; $i2 < 7; $i2++) {
				fwrite($infoFile, $weekdaysArray[$i-1][$i4][$i2] . "\n");
			}
			fwrite($infoFile, $customStartArray[$i-1][$i4] . "\n");
			fwrite($infoFile, $customStopArray[$i-1][$i4] . "\n");
			fwrite($infoFile, $summaryMethodArray[$i-1][$i4] . "\n");
		}
	}
}

?>