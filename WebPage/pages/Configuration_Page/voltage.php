<?php
	$html_sensor_list .= '<p style="font-weight:bold;"> Wattage </p>' . "\n";
	$html_sensor_list .= '<input type="number" class="form-control" name="wattage'. ($i+1) . '" placeholder="wattage" value="' . $SENSOR_INFO[$i]->wattage .'">' . "\n";
	$html_sensor_list .= '<br>' . "\n";
?>