<?php

$numPiFile = fopen("/home/cjk36/Desktop/CERF-DAQ/WebPage/pages/piNumber.txt", "r");

$PI_NUMBER = fgets($numPiFile);

$PI_NUMBER = intval($PI_NUMBER);

fclose($numPiFile);

$numSensorFile = fopen("/home/cjk36/Desktop/CERF-DAQ/WebPage/pages/numSensors.txt", "r");

$NUM_SENSORS = fgets($numSensorFile);

$NUM_SENSORS = intval($NUM_SENSORS);

fclose($numSensorFile);

$analysisStatusFile = fopen("/home/cjk36/Desktop/CERF-DAQ/WebPage/pages/analysisStatus.txt", "r");

$BUSY = trim(fgets($analysisStatusFile));

$CALL_FUNCTION = false;

if (isset($_GET['callFunction'])) {
	$CALL_FUNCTION = true;
}

include 'sensorClass.php';

$sensorInfoFile = fopen("/home/cjk36/Desktop/CERF-DAQ/WebPage/pages/sensorInfo.txt", "r");

$SENSOR_INFO = new ArrayObject(array());

for ($i=1; $i <= $NUM_SENSORS; $i++) { 
	$SENSOR_INFO->append(new sensor($i));
	// echo "Sensor Number: ";
	// echo $SENSOR_INFO[$i-1]->number . "\n";
	$SENSOR_INFO[$i-1]->set_name(trim(fgets($sensorInfoFile)));
	// echo "Sensor Name: ";
	// echo $SENSOR_INFO[$i-1]->name . "\n";
	$SENSOR_INFO[$i-1]->set_type(trim(fgets($sensorInfoFile)));
	// echo "Sensor Type: ";
	// echo $SENSOR_INFO[$i-1]->type . "\n";
	$SENSOR_INFO[$i-1]->set_i2cAddress(trim(fgets($sensorInfoFile)));
	// echo "i2c Address: ";
	// echo $SENSOR_INFO[$i-1]->i2cAddress . "\n";
	$SENSOR_INFO[$i-1]->set_pinNumber(trim(fgets($sensorInfoFile)));
	// echo "Pin Number: ";
	// echo $SENSOR_INFO[$i-1]->pinNumber . "\n";
	$SENSOR_INFO[$i-1]->set_numberOfAnalysis(trim(fgets($sensorInfoFile)));
	// echo "Number Of Analysis: ";
	// echo $SENSOR_INFO[$i-1]->numberOfAnalysis . "\n";
	
	for ($i4 = 0; $i4 < 3; $i4++){
		$SENSOR_INFO[$i-1]->set_analysis(trim(fgets($sensorInfoFile)), $i4);
		// echo "Analysis Type" . ($i4+1) . ": ";
		// echo $SENSOR_INFO[$i-1]->analysis[$i4] . "\n";
		$SENSOR_INFO[$i-1]->set_threshold(trim(fgets($sensorInfoFile)),trim(fgets($sensorInfoFile)), $i4);
		// echo "Threshold min and max" . ($i4+1) . ": ";
		// echo $SENSOR_INFO[$i-1]->thresholdMin[$i4] . " " . $SENSOR_INFO[$i-1]->thresholdMax[$i4] . "\n";
		$SENSOR_INFO[$i-1]->set_binType(trim(fgets($sensorInfoFile)), $i4);
		// echo "Bin Type" . ($i4+1) . ": ";
		// echo $SENSOR_INFO[$i-1]->binType[$i4] . "\n";
		$SENSOR_INFO[$i-1]->set_fromSensorNumber(trim(fgets($sensorInfoFile)), $i4);
		// echo "From Sensor Number" . ($i4+1) . ": ";
		// echo $SENSOR_INFO[$i-1]->fromSensorNumber[$i4] . "\n";
		$SENSOR_INFO[$i-1]->set_fromSensorMin(trim(fgets($sensorInfoFile)), $i4);
		// echo "From Sensor Min" . ($i4+1) . ": ";
		// echo $SENSOR_INFO[$i-1]->fromSensorMin[$i4] . "\n";
		$SENSOR_INFO[$i-1]->set_fromSensorMax(trim(fgets($sensorInfoFile)), $i4);
		// echo "From Sensor Max" . ($i4+1) . ": ";
		// echo $SENSOR_INFO[$i-1]->fromSensorMax[$i4] . "\n";
		$SENSOR_INFO[$i-1]->set_weekdays(trim(fgets($sensorInfoFile)),trim(fgets($sensorInfoFile)),trim(fgets($sensorInfoFile)),trim(fgets($sensorInfoFile)),trim(fgets($sensorInfoFile)),trim(fgets($sensorInfoFile)),trim(fgets($sensorInfoFile)), $i4);
		// echo "Weekdays" . ($i4+1) . ": ";
		// echo $SENSOR_INFO[$i-1]->weekdays[$i4][0] . "\n";
		$SENSOR_INFO[$i-1]->set_customStartStop(trim(fgets($sensorInfoFile)), trim(fgets($sensorInfoFile)), $i4);
		// echo "Custom Start and Stop" . ($i4+1) . ": ";
		// echo $SENSOR_INFO[$i-1]->customStart[$i4] . " " . $SENSOR_INFO[$i-1]->customStop[$i4] . "\n";
		$SENSOR_INFO[$i-1]->set_summaryMethod(trim(fgets($sensorInfoFile)), $i4);
		// echo "Summary Method" . ($i4+1) . ": ";
		// echo $SENSOR_INFO[$i-1]->summaryMethod[$i4] . "\n";
	}
}	

fclose($sensorInfoFile);

?>