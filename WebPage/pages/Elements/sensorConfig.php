<?php include '../global_vars.php'; ?>

<?php
$pageLink = 'configuration.php';
$html_sensor_list = "";
for ($i=0; $i < $NUMBER_OF_SENSORS; $i++){
	$html_sensor_list .= '<div class="panel panel-default">';
		$html_sensor_list .= '<div class="panel-heading">Sensor ' . ($i+1) . ' Specifics</div>';
		$html_sensor_list .= '<div class="panel-body">';
		$html_sensor_list .= '<div class="row">';
		$html_sensor_list .= '<form action="configuration.php" id="sensorSpecifics" method="get">';
			$html_sensor_list .= '<div class="col-lg-4">';
					$html_sensor_list .= '<p style="font-weight:bold;"> Sensor Name </p>';
					$html_sensor_list .= '<input type="text" class="form-control" name="name' . ($i+1) . '" placeholder="Name">';
				$html_sensor_list .= '<br>';
				$html_sensor_list .= '<br>';
			$html_sensor_list .= '</div> <!-- col-lg-4 -->';
			$html_sensor_list .= '<div class="col-lg-4">';
					$html_sensor_list .= '<p style="font-weight:bold;"> Sensor Type </p>';
					$html_sensor_list .= '<select class="form-control" name="sensor' . ($i+1) .'type"';
					$html_sensor_list .= '<br>';
					$html_sensor_list .= '<option>Light</option>';
					$html_sensor_list .= '<option>Temperature</option>';
					$html_sensor_list .= '<option>Occupancy</option>';
					$html_sensor_list .= '</select>';
					$html_sensor_list .= '<br>';
					$html_sensor_list .= '<p style="font-weight:bold;"> Analysis Type </p>';
					$html_sensor_list .= '<select class="form-control" name="analysis' . ($i+1) .'type"';
					$html_sensor_list .= '<br>';
					$html_sensor_list .= '<option>Peak</option>';
					$html_sensor_list .= '<option>Min/Max</option>';
					$html_sensor_list .= '<option>Bins</option>';
					$html_sensor_list .= '</select>';
				$html_sensor_list .= '<br>';
				$html_sensor_list .= '<br>';
			$html_sensor_list .= '</div> <!-- col-lg-4 -->';
			$html_sensor_list .= '<div class="col-lg-2">';
					$html_sensor_list .= '<p style="font-weight:bold;"> Peak Hour Start </p>';
					$html_sensor_list .= '<select class="form-control" name="peakStart' . ($i+1) .'"';
					$html_sensor_list .= '<br>';

					$options = "";
						$i2 = 1;
						while ($i2 < 25) {
							$options .= ("<option>" . $i2 . "</option>" . "\n");
							$i2 += 1;
						}
					$html_sensor_list .=  $options;

					$html_sensor_list .= ' . $options . ';
					$html_sensor_list .= '</select>';
					$html_sensor_list .= '<br>';
					$html_sensor_list .= '<p style="font-weight:bold;"> Peak Hour Stop </p>';
					$html_sensor_list .= '<select class="form-control" name="peakStop' . ($i+1) .'"';
					$html_sensor_list .= '<br>';

					$options = "";
						$i2 = 1;
						while ($i2 < 25) {
							$options .= ("<option>" . $i2 . "</option>" . "\n");
							$i2 += 1;
						}
					$html_sensor_list .=  $options;
					$html_sensor_list .= ' . $options . ';
					$html_sensor_list .= '</select>';
				$html_sensor_list .= '<br>';
				$html_sensor_list .= '<br>';
			$html_sensor_list .= '</div> <!-- col-lg-2 -->';
			$html_sensor_list .= '<div class="col-lg-2">';
				$html_sensor_list .= '<form action="<?php echo $pageLink?>" id="sensorSpecifics" method="get">';
					$html_sensor_list .= '<p style="font-weight:bold;"> Threshold Min </p>';
					$html_sensor_list .= '<input type="text" class="form-control" name="min' . ($i+1) . '" placeholder="min">';
					$html_sensor_list .= '<br>';
					$html_sensor_list .= '<p style="font-weight:bold;"> Threshold Max </p>';
					$html_sensor_list .= '<input type="text" class="form-control" name="max' . ($i+1) . '" placeholder="max">';
				$html_sensor_list .= '<br>';
				$html_sensor_list .= '<br>';
			$html_sensor_list .= '</div> <!-- col-lg-2 -->';
	$html_sensor_list .= '</form>';
	$html_sensor_list .= '</div> <!-- row -->';
	$html_sensor_list .= '</div> <!-- panel2-body -->';
	$html_sensor_list .= '</div> <!-- panel2 panel2-default -->';
}
$html_sensor_list .= '<button style="margin-left:auto; margin-right:auto;" type="submit" form="sensorSpecifics" class="btn btn-primary btn-block">Submit</button>';

echo $html_sensor_list;

?>