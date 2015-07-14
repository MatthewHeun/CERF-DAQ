<?php
	$html_sensor_list .= '<p style="font-weight:bold;"> Pin Number </p>' . "\n";
	$html_sensor_list .= '<select class="form-control" name="pin' . ($i+1) .'">' . "\n";
	$html_sensor_list .= '<br>' . "\n";
	$options = "";
		$i2 = 0;
		while ($i2 < 49) {
			if ($i2 == $SENSOR_INFO[$i]->pinNumber) {
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

?>