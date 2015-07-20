<?php
	$html_sensor_list .= '<p style="font-weight:bold;"> Analysis ' . ($i3) . ' Type </p>' . "\n";
	$html_sensor_list .= '<select class="form-control" name="analysis' . ($i3) . ($i+1) .'type" id="analysis' . ($i3) . ($i+1) . '">' . "\n";
	$html_sensor_list .= '<br>' . "\n";
	if ($SENSOR_INFO[$i]->analysis[$i3-1] == "Range Analysis"){
		$html_sensor_list .= '<option selected="selected">Range Analysis</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>Range Analysis</option>' . "\n";
	}
	if ($SENSOR_INFO[$i]->analysis[$i3-1] == "On-Peak Off-Peak %"){
		$html_sensor_list .= '<option selected="selected">On-Peak Off-Peak %</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>On-Peak Off-Peak %</option>' . "\n";
	}
	if ($SENSOR_INFO[$i]->analysis[$i3-1] == "Min-Max"){
		$html_sensor_list .= '<option selected="selected">Min-Max</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>Min-Max</option>' . "\n";
	}
	if ($SENSOR_INFO[$i]->analysis[$i3-1] == "kWh"){
		$html_sensor_list .= '<option selected="selected">kWh</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>kWh</option>' . "\n";
	}
	$html_sensor_list .= '</select>' . "\n";

?>