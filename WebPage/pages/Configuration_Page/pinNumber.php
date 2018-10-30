<?php
	$html_sensor_list .= '<p style="font-weight:bold;"> Pin Number </p>' . "\n";
	$html_sensor_list .= '<select class="form-control" name="pin' . ($i+1) .'">' . "\n";
	$html_sensor_list .= '<br>' . "\n";
	$options = "";
		$i2 = 0;
		$pinArray = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40);
		while ($i2 < 49) {
			if (in_array($i2, $pinArray)){
				if ($i2 == $SENSOR_INFO[$i]->pinNumber) {
					$options .= ('<option selected="selected">' . $i2 . "</option>" . "\n");
				} 
				else { 
					$options .= ("<option>" . $i2 . "</option>" . "\n");
				}
			}
			$i2 += 1;
		}
	$html_sensor_list .=  $options;

	$html_sensor_list .= ' . $options . ' . "\n";
	$html_sensor_list .= '</select>' . "\n";
	$html_sensor_list .= '<br>' . "\n";

?>