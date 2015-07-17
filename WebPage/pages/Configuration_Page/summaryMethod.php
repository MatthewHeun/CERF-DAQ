<?php

	$html_sensor_list .= '<p style="font-weight:bold;"> Aggregate Data By: </p>' . "\n";
	$html_sensor_list .= '<select class="form-control" name="summaryFormat' . ($i3) . ($i+1) . '">' . "\n";
	$html_sensor_list .= '<br>' . "\n";
	if ($SENSOR_INFO[$i]->summaryMethod[$i3-1] == "Year"){
		$html_sensor_list .= '<option selected="selected">Year</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>Year</option>' . "\n";
	}
	if ($SENSOR_INFO[$i]->summaryMethod[$i3-1] == "Month"){
		$html_sensor_list .= '<option selected="selected">Month</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>Month</option>' . "\n";
	}
	if ($SENSOR_INFO[$i]->summaryMethod[$i3-1] == "None"){
		$html_sensor_list .= '<option selected="selected">None</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>None</option>' . "\n";
	}
	$html_sensor_list .= '</select>' . "\n";
	$html_sensor_list .= '<br>' . "\n";

?>