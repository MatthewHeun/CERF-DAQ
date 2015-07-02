<?php

$numPiFile = fopen("/home/cjk36/Desktop/CERF-DAQ/WebPage/pages/piNumber.txt", "r");

$PI_NUMBER = fgets($numPiFile);

$PI_NUMBER = intval($PI_NUMBER);

fclose($numPiFile);

$numSensorFile = fopen("/home/cjk36/Desktop/CERF-DAQ/WebPage/pages/numSensors.txt", "r");

$NUM_SENSORS = fgets($numSensorFile);

$NUM_SENSORS = intval($NUM_SENSORS);

fclose($numSensorFile);

#$analysisStatusFile = fopen("/home/cjk36/Desktop/CERF-DAQ/WebPage/pages/sensorInfo.txt", "r");

$CALL_FUNCTION = false;

if (isset($_GET['callFunction'])) {
	$CALL_FUNCTION = true;
}

include 'sensorClass.php';

$sensorInfoFile = fopen("/home/cjk36/Desktop/CERF-DAQ/WebPage/pages/sensorInfo.txt", "r");

$SENSOR_INFO = new ArrayObject(array());

for ($i=1; $i <= $NUM_SENSORS; $i++) { 
	$SENSOR_INFO->append(new sensor($i));
	#echo $SENSOR_INFO[$i-1]->number . " ";
	$SENSOR_INFO[$i-1]->set_name(trim(fgets($sensorInfoFile)));
	#echo $SENSOR_INFO[$i-1]->name . " ";
	$SENSOR_INFO[$i-1]->set_type(trim(fgets($sensorInfoFile)));
	#echo $SENSOR_INFO[$i-1]->type . " ";
	$SENSOR_INFO[$i-1]->set_analysis(trim(fgets($sensorInfoFile)));
	#echo $SENSOR_INFO[$i-1]->analysis . " ";
	$SENSOR_INFO[$i-1]->set_peak(trim(fgets($sensorInfoFile)), trim(fgets($sensorInfoFile)));
	#echo $SENSOR_INFO[$i-1]->peakStart . " " . $SENSOR_INFO[$i-1]->peakStop . " ";
	$SENSOR_INFO[$i-1]->set_threshold(trim(fgets($sensorInfoFile)), trim(fgets($sensorInfoFile)));
	#echo $SENSOR_INFO[$i-1]->thresholdMin . " " . $SENSOR_INFO[$i-1]->thresholdMax;
	$SENSOR_INFO[$i-1]->set_i2cAddress(trim(fgets($sensorInfoFile)));
	#echo $SENSOR_INFO[$i-1]->i2cAddress . " ";
	$SENSOR_INFO[$i-1]->set_pinNumber(trim(fgets($sensorInfoFile)));
	#echo $SENSOR_INFO[$i-1]->pinNumber . "\n";
	}	

$formData = new ArrayObject(array());
for ($i = 1; $i <= $NUM_SENSORS; $i++) {
	$formData->append("analysis" . $i);
}

foreach ($formData as $key => $analysis_type) {
	if(isset($_GET[$analysis_type])){
		$Analysis = $_GET[$analysis_type];
		if ($Analysis == 'On/Off Peak Analysis'){
			$Analysis = "Peak";
		} elseif ($Analysis == 'Min/Max/Average Analysis') {
			$Analysis = "Min-Max";
		} elseif ($Analysis == "Bin Analysis") {
			$Analysis = "Bins";
		}
		$SENSOR_INFO[$key]->set_analysis($Analysis);
	}
}

fclose($sensorInfoFile);

?>