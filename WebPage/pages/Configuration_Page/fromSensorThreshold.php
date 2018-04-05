<?php

	$html_sensor_list .= '<p style="font-weight:bold;"> Threshold Min </p>' . "\n";
	$html_sensor_list .= '<input type="number" step="0.5" class="form-control" name="fromSensorMin' . ($i3) . ($i+1) . '" placeholder="min" value="' . $SENSOR_INFO[$i]->fromSensorMin[$i3-1] .'">' . "\n";
	$html_sensor_list .= '<br>' . "\n";
	$html_sensor_list .= '<p style="font-weight:bold;"> Threshold Max </p>' . "\n";
	$html_sensor_list .= '<input type="number" step="0.5" class="form-control" name="fromSensorMax' . ($i3) . ($i+1) . '" placeholder="max" value="' . $SENSOR_INFO[$i]->fromSensorMax[$i3-1] . '">' . "\n";

?>