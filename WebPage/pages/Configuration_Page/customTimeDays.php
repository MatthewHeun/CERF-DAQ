<?php

	$html_sensor_list .= '<p style="font-weight:bold;"> Days: </p>' . "\n";
	$html_sensor_list .= '<div class="container">' . "\n";
	$html_sensor_list .= '<input type="checkbox" name="M' . ($i+1) . '" value="0"';
	if ($SENSOR_INFO[$i]->weekdays[0] == "0"){ $html_sensor_list .= ' checked="checked"'; }
	$html_sensor_list .= '> M<br>' . "\n";
	$html_sensor_list .= '<input type="checkbox" name="T' . ($i+1) . '" value="1"';
	if ($SENSOR_INFO[$i]->weekdays[1] == "1"){ $html_sensor_list .= ' checked="checked"'; }
	$html_sensor_list .= '> T<br>' . "\n";
	$html_sensor_list .= '<input type="checkbox" name="W' . ($i+1) . '" value="2"';
	if ($SENSOR_INFO[$i]->weekdays[2] == "2"){ $html_sensor_list .= ' checked="checked"'; }
	$html_sensor_list .= '> W<br>' . "\n";
	$html_sensor_list .= '<input type="checkbox" name="Th' . ($i+1) . '" value="3"';
	if ($SENSOR_INFO[$i]->weekdays[3] == "3"){ $html_sensor_list .= ' checked="checked"'; }
	$html_sensor_list .= '> Th<br>' . "\n";
	$html_sensor_list .= '<input type="checkbox" name="F' . ($i+1) . '" value="4"';
	if ($SENSOR_INFO[$i]->weekdays[4] == "4"){ $html_sensor_list .= ' checked="checked"'; }
	$html_sensor_list .= '> F<br>' . "\n";
	$html_sensor_list .= '<input type="checkbox" name="Sa' . ($i+1) . '" value="5"';
	if ($SENSOR_INFO[$i]->weekdays[5] == "5"){ $html_sensor_list .= ' checked="checked"'; }
	$html_sensor_list .= '> Sa<br>' . "\n";
	$html_sensor_list .= '<input type="checkbox" name="Su' . ($i+1) . '" value="6" style="margin:4px 0px 14px;"';
	if ($SENSOR_INFO[$i]->weekdays[6] == "6"){ $html_sensor_list .= ' checked="checked"'; }
	$html_sensor_list .= '> Su<br>' . "\n";
	$html_sensor_list .= '</div> <!-- container -->' . "\n";

?>