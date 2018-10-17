<?php include 'Sensors/globalSensorInfo.php' . "\n"; ?>
<?php
$pageLink = 'configuration.php' . "\n";
$html_sensor_list = '<form action="configuration.php" id="sensorSpecifics" method="get">' . "\n";
for ($i=0; $i < $NUM_SENSORS; $i++){
	$html_sensor_list .= '<div class="panel panel-default">' . "\n";
		$html_sensor_list .= '<div class="panel-heading">' . "\n";

		$Picture = "";
		if ($SENSOR_INFO[$i]->type == "Light"){
			$Picture = '<i class="fa fa-lightbulb-o fa-fw"></i>';
		} elseif ($SENSOR_INFO[$i]->type == "Temperature"){
			$Picture = '<i class="fa fa-tasks fa-fw"></i>';
		} elseif ($SENSOR_INFO[$i]->type == "Occupancy"){
			$Picture = '<i class="fa fa-child fa-fw"></i>';
		} elseif ($SENSOR_INFO[$i]->type == "Current"){
			$Picture = '<i class="fa fa-bolt fa-fw"></i>';
		}

		$html_sensor_list .= '<button type="button" onClick="toggleDisplay(' . ($i+1) . ')" style="background:none; border:none; margin:0; padding:0; cursor:pointer;"><i class="fa fa-caret-square-o-down fa-fw"></i> Sensor ' . ($i+1) . ': ' . $SENSOR_INFO[$i]->name . ' ' . $Picture . '</button></div>' . "\n";
		$html_sensor_list .= '<div class="panel-body" style="display:none;" id=panelBody'. ($i+1) . '>' . "\n";
		$html_sensor_list .= '<div class="row">' . "\n";

				//---------------------Name---------------------//

			$html_sensor_list .= '<div class="col-lg-4">' . "\n";

					$html_sensor_list .= '<p style="font-weight:bold;"> Sensor Name </p>' . "\n";
					$html_sensor_list .= '<input type="text" class="form-control" maxlength=14; name="name' . ($i+1) . '" placeholder="Name" value="' . $SENSOR_INFO[$i]->name . '">' . "\n";
				$html_sensor_list .= '<br>' . "\n";

			$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";
				
				//------------------i2c address-------------------//
			
			$displayString = '';
				//echo "CHECK HERE";
				//echo $SENSOR_INFO[$i]->type;
				if ($SENSOR_INFO[$i]->type == "Occupancy" || $SENSOR_INFO[$i]->type == "Current"){
					//echo "Changing Display";
					$displayString = ' style="display:none;"';
				}

			$html_sensor_list .= '<div class="col-lg-4" id="i2cAddress' . ($i+1) . '"' . $displayString . '>' . "\n";

				include 'i2cAddress.php';

			$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";

				//------------------------Sensor Type-----------------------//

			$html_sensor_list .= '<div class="col-lg-4">' . "\n";

				include 'sensorType.php';

			$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";

		$html_sensor_list .= '</div> <!-- row -->'. "\n";
		$html_sensor_list .= '<div class="row">' . "\n";

				//----------------------pinNumber---------------------//

			$html_sensor_list .= '<div class="col-lg-4">' . "\n";

				include 'pinNumber.php';

			$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";

			//--------------------------Analysis Type------------------------//

			$html_sensor_list .= '<div class="col-lg-4">' . "\n";
				
				include 'numberOfAnalysis.php';

			$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";
			
			//-------------------------Voltage Level-----------------------//
			
			$displayString = '';
				//echo "CHECK HERE";
				//echo $SENSOR_INFO[$i]->type;
				if ($SENSOR_INFO[$i]->type != "Current"){
					//echo "Changing Display";
					$displayString = ' style="display:none;"';
				}
			$html_sensor_list .= '<div class="col-lg-4" id="voltage' . ($i+1) . '"' . $displayString . '>' . "\n";

				include 'voltage.php';

			$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";

		//----------------------------Divider---------------------------//

		$html_sensor_list .= '</div> <!-- row -->' . "\n";	
				
		for ($i3 = 1; $i3 < 4; $i3 ++) {
			include 'binInformation.php';
		}

		$html_sensor_list .= '</div> <!-- panel-body -->' . "\n";
	$html_sensor_list .= '</div> <!-- panel panel-default -->' . "\n";
	$html_sensor_list .= '<button id="submit' . ($i+1) . '" onclick="loadAndAlert()" style="margin-left:auto; display:none; margin-right:auto;" type="submit" form="sensorSpecifics" class="btn btn-primary btn-block" name= "sensorInfo">Submit</button>' . "\n";
	$html_sensor_list .= '<br>' . "\n";
}
$html_sensor_list .= '</form>' . "\n";
$html_sensor_list .= '<button type="button" onclick="window.location.href=window.location.href" class="btn btn-primary btn-block">Display Updates!</button>' . "\n";
echo $html_sensor_list;

?>