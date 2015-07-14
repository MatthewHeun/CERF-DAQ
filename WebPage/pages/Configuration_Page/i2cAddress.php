<?php

	$html_sensor_list .=  	'<p style="font-weight:bold;"> i2c Address </p>' . "\n" . 
							'<select class="form-control" name ="i2c' . ($i+1) . '">' . "\n";
	
	if ($SENSOR_INFO[$i]->i2cAddress == "0x48"){
		$html_sensor_list .= '<option selected="selected">0x48</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>0x48</option>' . "\n";
	}

	if ($SENSOR_INFO[$i]->i2cAddress == "0x49"){
		$html_sensor_list .= '<option selected="selected">0x49</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>0x49</option>' . "\n";
	}

	if ($SENSOR_INFO[$i]->i2cAddress == "0x4A"){
		$html_sensor_list .= '<option selected="selected">0x4A</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>0x4A</option>' . "\n";
	}

	if ($SENSOR_INFO[$i]->i2cAddress == "0x4B"){
		$html_sensor_list .= '<option selected="selected">0x4B</option>' . "\n";
	} else {
		$html_sensor_list .= '<option>0x4B</option>' . "\n";
	}

	$html_sensor_list .= 	'</select>' . "\n" .
							'<br>' . "\n";

?>