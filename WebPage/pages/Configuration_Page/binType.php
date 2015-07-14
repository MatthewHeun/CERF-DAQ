<?php

	$html_sensor_list .= '<p style="font-weight:bold;"> Bin Characteristics </p>' . "\n";
	$html_sensor_list .= '<select class="form-control" id="binChoice' . ($i+1) . '" name="binType' . ($i+1) . '">' . "\n";
	$html_sensor_list .= '<br>' . "\n";
	if ($SENSOR_INFO[$i]->binType == "Year"){
		$html_sensor_list .= '<option selected="selected">Year</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>Year</option>' . "\n";
	}
	if ($SENSOR_INFO[$i]->binType == "Month"){
		$html_sensor_list .= '<option selected="selected">Month</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>Month</option>' . "\n";
	}
	if ($SENSOR_INFO[$i]->binType == "Day"){
		$html_sensor_list .= '<option selected="selected">Day</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>Day</option>' . "\n";
	}
	if ($SENSOR_INFO[$i]->binType == "From Sensor"){
		$html_sensor_list .= '<option selected="selected">From Sensor</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>From Sensor</option>' . "\n";
	}
	if ($SENSOR_INFO[$i]->binType == "Custom Time"){
		$html_sensor_list .= '<option selected="selected">Custom Time</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>Custom Time</option>' . "\n";
	}
	$html_sensor_list .= '</select>' . "\n";
	$html_sensor_list .= '<br>' . "\n";

?>