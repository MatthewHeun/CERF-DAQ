<?php

	$html_sensor_list .= '<p style="font-weight:bold;"> Threshold Min </p>' . "\n";
	$html_sensor_list .= '<input type="number" class="form-control" name="fromSensorMin' . ($i+1) . '" placeholder="min" value="' . $SENSOR_INFO[$i]->fromSensorMin .'">' . "\n";
	$html_sensor_list .= '<br>' . "\n";
	$html_sensor_list .= '<p style="font-weight:bold;"> Threshold Max </p>' . "\n";
	$html_sensor_list .= '<input type="number" class="form-control" name="fromSensorMax' . ($i+1) . '" placeholder="max" value="' . $SENSOR_INFO[$i]->fromSensorMax . '">' . "\n";

?>