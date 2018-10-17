<?php

	$html_sensor_list .= '<p style="font-weight:bold;"> Days: </p>' . "\n";
	$html_sensor_list .= '<div class="container">' . "\n";
	$html_sensor_list .= '<input type="checkbox" name="M' . ($i3) . ($i+1) . '" value="0"';
	if ($SENSOR_INFO[$i]->weekdays[$i3-1][0] == "0"){ $html_sensor_list .= ' checked="checked"'; }
	$html_sensor_list .= '> M<br>' . "\n";
	$html_sensor_list .= '<input type="checkbox" name="T' . ($i3) . ($i+1) . '" value="1"';
	if ($SENSOR_INFO[$i]->weekdays[$i3-1][1] == "1"){ $html_sensor_list .= ' checked="checked"'; }
	$html_sensor_list .= '> T<br>' . "\n";
	$html_sensor_list .= '<input type="checkbox" name="W' . ($i3) . ($i+1) . '" value="2"';
	if ($SENSOR_INFO[$i]->weekdays[$i3-1][2] == "2"){ $html_sensor_list .= ' checked="checked"'; }
	$html_sensor_list .= '> W<br>' . "\n";
	$html_sensor_list .= '<input type="checkbox" name="Th' . ($i3) . ($i+1) . '" value="3"';
	if ($SENSOR_INFO[$i]->weekdays[$i3-1][3] == "3"){ $html_sensor_list .= ' checked="checked"'; }
	$html_sensor_list .= '> Th<br>' . "\n";
	$html_sensor_list .= '<input type="checkbox" name="F' . ($i3) . ($i+1) . '" value="4"';
	if ($SENSOR_INFO[$i]->weekdays[$i3-1][4] == "4"){ $html_sensor_list .= ' checked="checked"'; }
	$html_sensor_list .= '> F<br>' . "\n";
	$html_sensor_list .= '<input type="checkbox" name="Sa' . ($i3) . ($i+1) . '" value="5"';
	if ($SENSOR_INFO[$i]->weekdays[$i3-1][5] == "5"){ $html_sensor_list .= ' checked="checked"'; }
	$html_sensor_list .= '> Sa<br>' . "\n";
	$html_sensor_list .= '<input type="checkbox" name="Su' . ($i3) . ($i+1) . '" value="6" style="margin:4px 0px 14px;"';
	if ($SENSOR_INFO[$i]->weekdays[$i3-1][6] == "6"){ $html_sensor_list .= ' checked="checked"'; }
	$html_sensor_list .= '> Su<br>' . "\n";
	$html_sensor_list .= '</div> <!-- container -->' . "\n";

?>