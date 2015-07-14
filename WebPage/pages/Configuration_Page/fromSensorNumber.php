<?php 

	$html_sensor_list .= '<p style="font-weight:bold;"> Sensor Number </p>' . "\n";
	$html_sensor_list .= '<select class="form-control" name="fromSensorNumber' . ($i+1) . '">' . "\n";
		$options = "";
		$i2 = 1;
		while ($i2 < $NUM_SENSORS+1) {
			if ($i2 == $SENSOR_INFO[$i]->fromSensorNumber) {
				$options .= ('<option selected="selected">' . $i2 . "</option>" . "\n");
			}
			else {
				$options .= ("<option>" . $i2 . "</option>" . "\n");
			}
			$i2 += 1;
		}
		$html_sensor_list .= $options;
	$html_sensor_list .= '</select>' . "\n";
	$html_sensor_list .= '<br>' . "\n";

?>