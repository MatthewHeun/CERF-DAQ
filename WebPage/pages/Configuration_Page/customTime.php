<?php

	$html_sensor_list .= '<p style="font-weight:bold; margin:10px 0px;"> Start Hour </p>' . "\n";
	$html_sensor_list .= '<select class="form-control" name="customStart' . ($i3) . ($i+1) .'">' . "\n";
	$html_sensor_list .= '<br>' . "\n";

	$options = "";
		$i2 = 0;
		while ($i2 < 24) {
			if ($i2 == $SENSOR_INFO[$i]->customStart[$i3-1]) {
				$options .= ('<option selected="selected">' . $i2 . "</option>" . "\n");
			} 
			else { 
				$options .= ("<option>" . $i2 . "</option>" . "\n");
			}
			$i2 += 1;
		}
	$html_sensor_list .=  $options;

	$html_sensor_list .= ' . $options . ' . "\n";
	$html_sensor_list .= '</select>' . "\n";
	$html_sensor_list .= '<br>' . "\n";
	$html_sensor_list .= '<p style="font-weight:bold;"> Stop Hour </p>' . "\n";
	$html_sensor_list .= '<select class="form-control" name="customStop' . ($i3) . ($i+1) .'">' . "\n";
	$html_sensor_list .= '<br>' . "\n";

	$options = "";
		$i2 = 0;
		while ($i2 < 24) {
			if ($i2 == $SENSOR_INFO[$i]->customStop[$i3-1]) {
				$options .= ('<option selected="selected">' . $i2 . "</option>" . "\n");
			} 
			else { 
				$options .= ("<option>" . $i2 . "</option>" . "\n");
			}
			$i2 += 1;
		}
	$html_sensor_list .=  $options;
	$html_sensor_list .= ' . $options . ' . "\n";
	$html_sensor_list .= '</select>' . "\n";

?>