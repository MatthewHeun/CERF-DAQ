<?php

$numSensorFile = fopen("/home/cjk36/Desktop/CERF-DAQ/WebPage/pages/numLightSensors.txt", "r");

$NUM_SENSORS = fgets($numSensorFile);

$NUM_SENSORS = intval($NUM_SENSORS);

fclose($numSensorFile);

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
	#echo $SENSOR_INFO[$i-1]->thresholdMin . " " . $SENSOR_INFO[$i-1]->thresholdMax . "\n";

	}	


?>