<?php

class sensor {
	public $name;
	public $type;
	public $analysis1;
	public $analysis2;
	public $analysis3;
	public $peakStart;
	public $peakStop;
	public $thresholdMin;
	public $thresholdMax;
	public $number;
	public $i2cAdress;
	public $pinNumber;
	public $binType;
	public $fromSensorNumber;
	public $fromSensorMin;
	public $fromSensorMax;
	public $weekdays;
	public $customStart;
	public $customStop;
	public $summaryMethod;
	public $numberOfAnalysis;
	public $wattage;
	public $voltage;
	public $mqttIP;
	public $mqttSensor;



	function __construct($sensor_number) {
		$this->name = ("sensor" . $sensor_number);
		$this->type = "";
		$this->i2cAddress = 0;
		$this->pinNumber = 0;
		$this->numberOfAnalysis = 0;
		$this->wattage = 0;
		$this->voltage = 0;
		$this->analysis = array("","","");
		$this->thresholdMin = array(0,0,0);
		$this->thresholdMax = array(0,0,0);
		$this->number = $sensor_number;
		$this->binType = array("","","");
		$this->fromSensorNumber = array(0,0,0);
		$this->fromSensorMin = array(0,0,0);
		$this->fromSensorMax = array(0,0,0);
		$this->weekdays = array(array(0,1,2,3,4,5,6),array(0,1,2,3,4,5,6),array(0,1,2,3,4,5,6));
		$this->customStart = array(0,0,0);
		$this->customStop = array(0,0,0);
		$this->summaryMethod = array("","","");
		$this->mqttIP = "";
		$this->mqttSensor = 0;
	}

	function set_name($new_name){
		$this->name = $new_name;
	}

	function set_type($new_type){
		$this->type = $new_type;
	}

	function set_i2cAddress($new_i2cAddress){
		$this->i2cAddress = $new_i2cAddress;
	}

	function set_pinNumber($new_pinNumber){
		$this->pinNumber = $new_pinNumber;
	}

	function set_numberOfAnalysis($new_number){
		$this->numberOfAnalysis =$new_number;
	}

	function set_wattage($new_wattage){
		$this->wattage = $new_wattage;
	}

	function set_voltage($new_voltage){
		$this->voltage = $new_voltage;
	}

	function set_analysis($new_analysis, $index){
		$this->analysis[$index] = $new_analysis;
	}

	function set_threshold($new_threshold_min, $new_threshold_max, $index){
		$this->thresholdMin[$index] = $new_threshold_min;
		$this->thresholdMax[$index] = $new_threshold_max;
	}

	function set_binType($new_binType, $index){
		$this->binType[$index] = $new_binType;
	}

	function set_fromSensorNumber($new_fromSensorNumber, $index){
		$this->fromSensorNumber[$index] = $new_fromSensorNumber;
	}

	function set_fromSensorMin($new_fromSensorMin, $index){
		$this->fromSensorMin[$index] = $new_fromSensorMin;
	}

	function set_fromSensorMax($new_fromSensorMax, $index){
		$this->fromSensorMax[$index] = $new_fromSensorMax;
	}

	function set_weekdays($new_M, $new_T, $new_W, $new_Th, $new_F, $new_Sa, $new_Su, $index){
		$this->weekdays[$index][0] = $new_M;
		$this->weekdays[$index][1] = $new_T;
		$this->weekdays[$index][2] = $new_W;
		$this->weekdays[$index][3] = $new_Th;
		$this->weekdays[$index][4] = $new_F;
		$this->weekdays[$index][5] = $new_Sa;
		$this->weekdays[$index][6] = $new_Su;
	}

	function set_customStartStop($new_customStart, $new_customStop, $index){
		$this->customStart[$index] = $new_customStart;
		$this->customStop[$index] = $new_customStop;
	}

	function set_summaryMethod($new_summaryMethod, $index){
		$this->summaryMethod[$index] = $new_summaryMethod;
	}

	function set_mqttIP($new_mqttIP) {
		$this->mqttIP = $new_mqttIP;
	}

	function set_mqttSensor($new_mqttSensor) {
		$this->mqttSensor = $new_mqttSensor;
	}
}

?>
