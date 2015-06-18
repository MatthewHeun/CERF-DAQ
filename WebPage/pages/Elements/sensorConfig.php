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
					$html_sensor_list .= '<input type="text" class="form-control" name="name' . ($i+1) . '" placeholder="Name">' . "\n";
				$html_sensor_list .= '<br>' . "\n";
				$html_sensor_list .= '<br>' . "\n";
			$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";
			$html_sensor_list .= '<div class="col-lg-4">' . "\n";
					$html_sensor_list .= '<p style="font-weight:bold;"> Sensor Type </p>' . "\n";
					$html_sensor_list .= '<select class="form-control" name="sensor' . ($i+1) .'type">' . "\n";
					$html_sensor_list .= '<br>' . "\n";
					$html_sensor_list .= '<option>Light</option>' . "\n";
					$html_sensor_list .= '<option>Temperature</option>' . "\n";
					$html_sensor_list .= '<option>Occupancy</option>' . "\n";
					$html_sensor_list .= '</select>' . "\n";
					$html_sensor_list .= '<br>' . "\n";
					$html_sensor_list .= '<p style="font-weight:bold;"> Analysis Type </p>' . "\n";
					$html_sensor_list .= '<select class="form-control" name="analysis' . ($i+1) .'type">' . "\n";
					$html_sensor_list .= '<br>' . "\n";
					$html_sensor_list .= '<option>Peak</option>' . "\n";
					$html_sensor_list .= '<option>Min/Max</option>' . "\n";
					$html_sensor_list .= '<option>Bins</option>' . "\n";
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
							$options .= ("<option>" . $i2 . "</option>" . "\n");
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
							$options .= ("<option>" . $i2 . "</option>" . "\n");
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
$html_sensor_list .= '<button style="margin-left:auto; margin-right:auto;" type="submit" form="sensorSpecifics" class="btn btn-primary btn-block" name= "sensorInfo">Submit</button>' . "\n";

echo $html_sensor_list;

?>