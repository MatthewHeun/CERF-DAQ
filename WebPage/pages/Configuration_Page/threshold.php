<?php

	$html_sensor_list .= '<p style="font-weight:bold;"> Threshold Min </p>' . "\n";
	$html_sensor_list .= '<input type="number" class="form-control" name="min' . ($i+1) . '" placeholder="min" value="' . $SENSOR_INFO[$i]->thresholdMin .'">' . "\n";
	$html_sensor_list .= '<br>' . "\n";
	$html_sensor_list .= '<p style="font-weight:bold;"> Threshold Max </p>' . "\n";
	$html_sensor_list .= '<input type="number" class="form-control" name="max' . ($i+1) . '" placeholder="max" value="' . $SENSOR_INFO[$i]->thresholdMax . '">' . "\n";

?>