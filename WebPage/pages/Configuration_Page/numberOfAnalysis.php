<?php
	$html_sensor_list .= '<p style="font-weight:bold;"> Number Of Analysis </p>' . "\n";
	$html_sensor_list .= '<select class="form-control" name="numberOfAnalysis' . ($i+1) .'" id="numAnalysis' . ($i+1) . '">' . "\n";
	$html_sensor_list .= '<br>' . "\n";
	if ($SENSOR_INFO[$i]->numberOfAnalysis == "1"){
		$html_sensor_list .= '<option selected="selected">1</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>1</option>' . "\n";
	}
	if ($SENSOR_INFO[$i]->numberOfAnalysis == "2"){
		$html_sensor_list .= '<option selected="selected">2</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>2</option>' . "\n";
	}
	if ($SENSOR_INFO[$i]->numberOfAnalysis == "3"){
		$html_sensor_list .= '<option selected="selected">3</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>3</option>' . "\n";
	}
	$html_sensor_list .= '</select>' . "\n";

?>