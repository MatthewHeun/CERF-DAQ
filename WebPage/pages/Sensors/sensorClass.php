<?php

class sensor {
	public $name;
	public $type;
	public $analysis;
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



	function __construct($sensor_number) {
		$this->name = ("sensor" . $sensor_number);
		$this->type = "light";
		$this->analysis = "peak";
		$this->peakStart = 11;
		$this->peakStop = 17;
		$this->thresholdMin = 25;
		$this->thresholdMax = 500;
		$this->number = $sensor_number;
		$this->i2cAddress = 0;
		$this->pinNumber = 0;
		$this->binType = "";
		$this->fromSensorNumber = 0;
		$this->fromSensorMin = 0;
		$this->fromSensorMax = 0;
		$this->weekdays = array(0,1,2,3,4,5,6);
		$this->customStart = 0;
		$this->customStop = 0;
		$this->summaryMethod = 0;
	}

	function set_name($new_name){
		$this->name = $new_name;
	}

	function set_type($new_type){
		$this->type = $new_type;
	}

	function set_analysis($new_analysis){
		$this->analysis = $new_analysis;
	}

	function set_peak($new_peak_start, $new_peak_stop){
		$this->peakStart = $new_peak_start;
		$this->peakStop = $new_peak_stop;
	}

	function set_threshold($new_threshold_min, $new_threshold_max){
		$this->thresholdMin = $new_threshold_min;
		$this->thresholdMax = $new_threshold_max;
	}

	function set_i2cAddress($new_i2cAddress){
		$this->i2cAddress = $new_i2cAddress;
	}

	function set_pinNumber($new_pinNumber){
		$this->pinNumber = $new_pinNumber;
	}

	function set_binType($new_binType){
		$this->binType = $new_binType;
	}

	function set_fromSensorNumber($new_fromSensorNumber){
		$this->fromSensorNumber = $new_fromSensorNumber;
	}

	function set_fromSensorMin($new_fromSensorMin){
		$this->fromSensorMin = $new_fromSensorMin;
	}

	function set_fromSensorMax($new_fromSensorMax){
		$this->fromSensorMax = $new_fromSensorMax;
	}

	function set_weekdays($new_M, $new_T, $new_W, $new_Th, $new_F, $new_Sa, $new_Su){
		$this->weekdays[0] = $new_M;
		$this->weekdays[1] = $new_T;
		$this->weekdays[2] = $new_W;
		$this->weekdays[3] = $new_Th;
		$this->weekdays[4] = $new_F;
		$this->weekdays[5] = $new_Sa;
		$this->weekdays[6] = $new_Su;
	}

	function set_customStartStop($new_customStart, $new_customStop){
		$this->customStart = $new_customStart;
		$this->customStop = $new_customStop;
	}

	function set_summaryMethod($new_summaryMethod){
		$this->summaryMethod = $new_summaryMethod;
	}
}

?>