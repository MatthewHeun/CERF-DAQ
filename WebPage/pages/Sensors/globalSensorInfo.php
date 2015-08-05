<?php

$numPiFile = fopen("/home/pi/Desktop/CERF-DAQ/WebPage/pages/piNumber.txt", "r");

$PI_NUMBER = fgets($numPiFile);

$PI_NUMBER = intval($PI_NUMBER);

fclose($numPiFile);

$numSensorFile = fopen("/home/pi/Desktop/CERF-DAQ/WebPage/pages/numSensors.txt", "r");

$NUM_SENSORS = fgets($numSensorFile);

$NUM_SENSORS = intval($NUM_SENSORS);

fclose($numSensorFile);

$onPeakOffPeakTimeFile = fopen("/home/pi/Desktop/CERF-DAQ/WebPage/pages/onPeakOffPeakTime.txt", "r");

$PEAK_START = trim(fgets($onPeakOffPeakTimeFile));

$PEAK_STOP = trim(fgets($onPeakOffPeakTimeFile));

$PEAK_WEEKDAY = new ArrayObject(array());

$PEAK_WEEKDAY->append(trim(fgets($onPeakOffPeakTimeFile)));

$PEAK_WEEKDAY->append(trim(fgets($onPeakOffPeakTimeFile)));

$PEAK_WEEKDAY->append(trim(fgets($onPeakOffPeakTimeFile)));

$PEAK_WEEKDAY->append(trim(fgets($onPeakOffPeakTimeFile)));

$PEAK_WEEKDAY->append(trim(fgets($onPeakOffPeakTimeFile)));

$PEAK_WEEKDAY->append(trim(fgets($onPeakOffPeakTimeFile)));

$PEAK_WEEKDAY->append(trim(fgets($onPeakOffPeakTimeFile)));

fclose($onPeakOffPeakTimeFile);


//this is to check if the analysis is running or not

$analysisStatusFile = fopen("/home/pi/Desktop/CERF-DAQ/WebPage/pages/analysisStatus.txt", "r");

$BUSY = trim(fgets($analysisStatusFile));


//this is to check if cron is running or not

$RUNNING = trim(exec('/etc/init.d/cron status'));

if ($RUNNING == "cron is running.") {
	$RUNNING = true;
} else {
	$RUNNING = false;
}

$CALL_FUNCTION = false;
$START_PI = false;
$PAUSE_PI = false;
$RESET_PI = false;
$ZIP_PI = false;


//this is to check if the data collection is set to run or not

$dataCollectionSetFile = fopen("/home/pi/Desktop/CERF-DAQ/WebPage/pages/dataCollectionSet.txt", "r");

$DATA_COLLECTION_SET = trim(fgets($dataCollectionSetFile));


//this is to check if the data collection python script has actually run 

$dataCollectionStatusFile = fopen("/home/pi/Desktop/CERF-DAQ/WebPage/pages/dataCollectionStatus.txt", "r");

$DATA_COLLECTION_STATUS = trim(fgets($dataCollectionStatusFile));


//this is to initiate the reset python script (within the Analysis.py script) 

$resetFile = fopen("/home/pi/Desktop/CERF-DAQ/WebPage/pages/reset.txt", "r");

$RESET_PI = trim(fgets($resetFile));


//this is to get the analysis progress

$progressFile = fopen("/home/pi/Desktop/CERF-DAQ/WebPage/pages/analysisPercentage.txt", "r");

$PROGRESS = trim(fgets($progressFile));


//this is to check to see if the zip data command has finished 

$zipStatusFile = fopen("/home/pi/Desktop/CERF-DAQ/WebPage/pages/zipStatus.txt", "r");

$ZIP_STATUS = trim(fgets($zipStatus));


//this is to get the zip health

$zipHealthFile = fopen("/home/pi/Desktop/CERF-DAQ/WebPage/pages/zipHealth.txt", "r");

$ZIP_HEALTH = trim(fgets($zipHealthFile));


//this is to get the update health

$updateHealthFile = fopen("/home/pi/Desktop/CERF-DAQ/WebPage/pages/updateHealth.txt", "r");

$UPDATE_HEALTH = trim(fgets($updateHealthFile));


if (isset($_GET['callFunction'])) {
	$CALL_FUNCTION = true;
}

if (isset($_GET['start-pi'])) {
	$START_PI = true;
}

if (isset($_GET['pause-pi'])) {
	$PAUSE_PI = true;
}

if (isset($_GET['reset-pi'])) {
	$RESET_PI = true;
}

if (isset($_GET['zip-pi'])) {
	$ZIP_PI = true;
}

include 'sensorClass.php';

$sensorInfoFile = fopen("/home/pi/Desktop/CERF-DAQ/WebPage/pages/sensorInfo.txt", "r");

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
	
	if (($SENSOR_INFO[$i-1]->numberOfAnalysis != "1") and ($SENSOR_INFO[$i-1]->numberOfAnalysis != "2") and ($SENSOR_INFO[$i-1]->numberOfAnalysis != "3")) {
		$SENSOR_INFO[$i-1]->set_numberOfAnalysis("1");
	}
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