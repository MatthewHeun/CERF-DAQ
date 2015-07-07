<?php

$numPiFile = fopen("/home/pi/Desktop/CERF-DAQ/WebPage/pages/piNumber.txt", "r");

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
	$SENSOR_INFO[$i-1]->set_analysis(trim(fgets($sensorInfoFile)));
	// echo "Analysis Type: ";
	// echo $SENSOR_INFO[$i-1]->analysis . "\n";
	$SENSOR_INFO[$i-1]->set_i2cAddress(trim(fgets($sensorInfoFile)));
	// echo "i2c Adress: ";
	// echo $SENSOR_INFO[$i-1]->i2cAddress . "\n";
	$SENSOR_INFO[$i-1]->set_pinNumber(trim(fgets($sensorInfoFile)));
	// echo "Pin Number: ";
	// echo $SENSOR_INFO[$i-1]->pinNumber . "\n";
	$SENSOR_INFO[$i-1]->set_binType(trim(fgets($sensorInfoFile)));
	// echo "Bin Type: ";
	// echo $SENSOR_INFO[$i-1]->binType . "\n";
	$SENSOR_INFO[$i-1]->set_fromSensorNumber(trim(fgets($sensorInfoFile)));
	// echo "From Sensor Number: ";
	// echo $SENSOR_INFO[$i-1]->fromSensorNumber . "\n";
	$SENSOR_INFO[$i-1]->set_fromSensorMin(trim(fgets($sensorInfoFile)));
	// echo "From Sensor Min: ";
	// echo $SENSOR_INFO[$i-1]->fromSensorMin . "\n";
	$SENSOR_INFO[$i-1]->set_fromSensorMax(trim(fgets($sensorInfoFile)));
	// echo "From Sensor Max: ";
	// echo $SENSOR_INFO[$i-1]->fromSensorMax . "\n";
	$SENSOR_INFO[$i-1]->set_weekdays(trim(fgets($sensorInfoFile)),trim(fgets($sensorInfoFile)),trim(fgets($sensorInfoFile)),trim(fgets($sensorInfoFile)),trim(fgets($sensorInfoFile)),trim(fgets($sensorInfoFile)),trim(fgets($sensorInfoFile)));
	// echo "Weekdays: ";
	// echo $SENSOR_INFO[$i-1]->weekdays[0] . "\n";
	$SENSOR_INFO[$i-1]->set_customStartStop(trim(fgets($sensorInfoFile)), trim(fgets($sensorInfoFile)));
	// echo "Custom Start and Stop ";
	// echo $SENSOR_INFO[$i-1]->customStart . " " . $SENSOR_INFO[$i-1]->customStop . "\n";
	$SENSOR_INFO[$i-1]->set_summaryMethod(trim(fgets($sensorInfoFile)));
	// echo "Summary Method: ";
	// echo $SENSOR_INFO[$i-1]->summaryMethod . "\n";
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