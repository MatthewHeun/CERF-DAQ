<?php
	$html_sensor_list .= '<div class="col-lg-4">' . "\n";
	$html_sensor_list .= '<p style="font-weight:bold;"> MQTT Server IP </p>' . "\n";
	$html_sensor_list .= '<input type="text" class="form-control" name="mqttIP'. ($i+1) . '" placeholder="XXX.XXX.XXX.XXX" value="' . $SENSOR_INFO[$i]->mqttIP . '">' . "\n";
	$html_sensor_list .= '<br>' . "\n";
	$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";

	$html_sensor_list .= '<div class="col-lg-4">' . "\n";
	$html_sensor_list .= '<p style="font-weight:bold;"> MQTT Sensor ID </p>' . "\n";
	$html_sensor_list .= '<input type="number" class="form-control" name="mqttSensor'. ($i+1) . '" placeholder="0123456" value="' . $SENSOR_INFO[$i]->mqttSensor .'">' . "\n";
	$html_sensor_list .= '<br>' . "\n";
	$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";

?>