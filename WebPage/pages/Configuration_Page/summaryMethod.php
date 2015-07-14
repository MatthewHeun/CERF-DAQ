<?php

	$html_sensor_list .= '<p style="font-weight:bold;"> Aggregate Data By: </p>' . "\n";
	$html_sensor_list .= '<select class="form-control" name="summaryFormat' . ($i+1) . '">' . "\n";
	$html_sensor_list .= '<br>' . "\n";
	if ($SENSOR_INFO[$i]->summaryMethod == "Year"){
		$html_sensor_list .= '<option selected="selected">Year</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>Year</option>' . "\n";
	}
	if ($SENSOR_INFO[$i]->summaryMethod == "Month"){
		$html_sensor_list .= '<option selected="selected">Month</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>Month</option>' . "\n";
	}
	if ($SENSOR_INFO[$i]->summaryMethod == "None"){
		$html_sensor_list .= '<option selected="selected">None</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>None</option>' . "\n";
	}
	$html_sensor_list .= '</select>' . "\n";
	$html_sensor_list .= '<br>' . "\n";

?>