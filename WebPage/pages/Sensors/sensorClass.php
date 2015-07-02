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

}

?>