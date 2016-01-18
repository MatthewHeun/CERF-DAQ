<?php

	$html_sensor_list .= '<p style="font-weight:bold;"> Sensor Type </p>' . "\n";
	$html_sensor_list .= '<select class="form-control" name="sensor' . ($i+1) .'type" id="sensorType' . ($i+1) . '">' . "\n";
	$html_sensor_list .= '<br>' . "\n";
	if ($SENSOR_INFO[$i]->type == "Light"){
		$html_sensor_list .= '<option selected="selected">Light</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>Light</option>' . "\n";
	}
	if ($SENSOR_INFO[$i]->type == "Temperature"){
		$html_sensor_list .= '<option selected="selected">Temperature</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>Temperature</option>' . "\n";
	}
	if ($SENSOR_INFO[$i]->type == "Occupancy"){
		$html_sensor_list .= '<option selected="selected">Occupancy</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>Occupancy</option>' . "\n";
	}
	if ($SENSOR_INFO[$i]->type == "Current"){
		$html_sensor_list .= '<option selected="selected">Current</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>Current</option>' . "\n";
	}
	$html_sensor_list .= '</select>' . "\n";
	$html_sensor_list .= '<br>' . "\n";

?>