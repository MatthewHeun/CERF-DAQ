<?php include '../global_vars.php' . "\n"; ?>

<?php
$pageLink = 'configuration.php' . "\n";
$html_sensor_list = '<form action="configuration.php" id="sensorSpecifics" method="get">' . "\n";
for ($i=0; $i < $NUMBER_OF_SENSORS; $i++){
	$html_sensor_list .= '<div class="panel panel-default">' . "\n";
		$html_sensor_list .= '<div class="panel-heading">Sensor ' . ($i+1) . ' Specifics</div>' . "\n";
		$html_sensor_list .= '<div class="panel-body">' . "\n";
		$html_sensor_list .= '<div class="row">' . "\n";
			$html_sensor_list .= '<div class="col-lg-4">' . "\n";
					$html_sensor_list .= '<p style="font-weight:bold;"> Sensor Name </p>' . "\n";
					$html_sensor_list .= '<input type="text" class="form-control" name="name' . ($i+1) . '" placeholder="Name" value="' . $SENSOR_INFO[$i]->name . '">' . "\n";
				$html_sensor_list .= '<br>' . "\n";
				$html_sensor_list .= '<br>' . "\n";
			$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";
			$html_sensor_list .= '<div class="col-lg-4">' . "\n";
					$html_sensor_list .= '<p style="font-weight:bold;"> Sensor Type </p>' . "\n";
					$html_sensor_list .= '<select class="form-control" name="sensor' . ($i+1) .'type">' . "\n";
					$html_sensor_list .= '<br>' . "\n";
					if ($SENSOR_INFO[$i-1]->type == "Light"){
						$html_sensor_list .= '<option selected="selected">Light</option>' . "\n";
					} else {
						$html_sensor_list .= '<option>Light</option>' . "\n";
					}
					if ($SENSOR_INFO[$i]->type == "Temperature"){
						$html_sensor_list .= '<option selected="selected">Temperature</option>' . "\n";
					} else {
						$html_sensor_list .= '<option>Temperature</option>' . "\n";
					}
					if ($SENSOR_INFO[$i]->type == "Occupancy"){
						$html_sensor_list .= '<option selected="selected">Occupancy</option>' . "\n";
					} else {
						$html_sensor_list .= '<option>Occupancy</option>' . "\n";
					}
					$html_sensor_list .= '</select>' . "\n";
					$html_sensor_list .= '<br>' . "\n";
					$html_sensor_list .= '<p style="font-weight:bold;"> Analysis Type </p>' . "\n";
					$html_sensor_list .= '<select class="form-control" name="analysis' . ($i+1) .'type">' . "\n";
					$html_sensor_list .= '<br>' . "\n";
					if ($SENSOR_INFO[$i]->analysis == "Peak"){
						$html_sensor_list .= '<option selected="selected">Peak</option>' . "\n";
					} else {
						$html_sensor_list .= '<option>Peak</option>' . "\n";
					}
					if ($SENSOR_INFO[$i]->analysis == "Min/Max"){
						$html_sensor_list .= '<option selected="selected">Min/Max</option>' . "\n";
					} else {
						$html_sensor_list .= '<option>Min/Max</option>' . "\n";
					}
					if ($SENSOR_INFO[$i]->analysis == "Bins"){
						$html_sensor_list .= '<option selected="selected">Bins</option>' . "\n";
					} else {
						$html_sensor_list .= '<option>Bins</option>' . "\n";
					}
					$html_sensor_list .= '</select>' . "\n";
				$html_sensor_list .= '<br>' . "\n";
				$html_sensor_list .= '<br>' . "\n";
			$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";
			$html_sensor_list .= '<div class="col-lg-2">' . "\n";
					$html_sensor_list .= '<p style="font-weight:bold;"> Peak Hour Start </p>' . "\n";
					$html_sensor_list .= '<select class="form-control" name="peakStart' . ($i+1) .'">' . "\n";
					$html_sensor_list .= '<br>' . "\n";

					$options = "";
						$i2 = 1;
						while ($i2 < 25) {
							if ($i2 == $SENSOR_INFO[$i]->peakStart) {
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
					$html_sensor_list .= '<p style="font-weight:bold;"> Peak Hour Stop </p>' . "\n";
					$html_sensor_list .= '<select class="form-control" name="peakStop' . ($i+1) .'">' . "\n";
					$html_sensor_list .= '<br>' . "\n";

					$options = "";
						$i2 = 1;
						while ($i2 < 25) {
							if ($i2 == $SENSOR_INFO[$i]->peakStop) {
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
				$html_sensor_list .= '<br>' . "\n";
			$html_sensor_list .= '</div> <!-- col-lg-2 -->' . "\n";
			$html_sensor_list .= '<div class="col-lg-2">' . "\n";
					$html_sensor_list .= '<p style="font-weight:bold;"> Threshold Min </p>' . "\n";
					$html_sensor_list .= '<input type="text" class="form-control" name="min' . ($i+1) . '" placeholder="min">' . "\n";
					$html_sensor_list .= '<br>' . "\n";
					$html_sensor_list .= '<p style="font-weight:bold;"> Threshold Max </p>' . "\n";
					$html_sensor_list .= '<input type="text" class="form-control" name="max' . ($i+1) . '" placeholder="max">' . "\n";
				$html_sensor_list .= '<br>' . "\n";
				$html_sensor_list .= '<br>' . "\n";
			$html_sensor_list .= '</div> <!-- col-lg-2 -->' . "\n";
	$html_sensor_list .= '</div> <!-- row -->' . "\n";
	$html_sensor_list .= '</div> <!-- panel2-body -->' . "\n";
	$html_sensor_list .= '</div> <!-- panel2 panel2-default -->' . "\n";
}
$html_sensor_list .= '</form>' . "\n";
$html_sensor_list .= '<button onclick="alert(' . "'" . 'the browser will automatically refresh after the changes have taken place' . "'" . ');" style="margin-left:auto; margin-right:auto;" type="submit" form="sensorSpecifics" class="btn btn-primary btn-block" name= "sensorInfo">Submit</button>' . "\n";

echo $html_sensor_list;

?>