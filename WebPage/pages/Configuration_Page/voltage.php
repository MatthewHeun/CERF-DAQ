<?php
	$html_sensor_list .= '<p style="font-weight:bold;"> Voltage </p>' . "\n";
	$html_sensor_list .= '<input type="number" class="form-control" name="voltage'. ($i+1) . '" placeholder="voltage" value="' . $SENSOR_INFO[$i]->voltage .'">' . "\n";
	$html_sensor_list .= '<br>' . "\n";
?>