<?php

	$html_sensor_list .= '<p style="font-weight:bold;"> Threshold Min </p>' . "\n";
	$html_sensor_list .= '<input type="number" class="form-control" name="min' . ($i3) . ($i+1) . '" placeholder="min" value="' . $SENSOR_INFO[$i]->thresholdMin[$i3-1] .'">' . "\n";
	$html_sensor_list .= '<br>' . "\n";
	$html_sensor_list .= '<p style="font-weight:bold;"> Threshold Max </p>' . "\n";
	$html_sensor_list .= '<input type="number" class="form-control" name="max' . ($i3) . ($i+1) . '" placeholder="max" value="' . $SENSOR_INFO[$i]->thresholdMax[$i3-1] . '">' . "\n";

?>