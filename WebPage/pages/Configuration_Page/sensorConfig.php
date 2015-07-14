<?php include '../global_vars.php' . "\n"; ?>
<?php
$pageLink = 'configuration.php' . "\n";
$html_sensor_list = '<form action="configuration.php" id="sensorSpecifics" method="get">' . "\n";
for ($i=0; $i < $NUM_SENSORS; $i++){
	$html_sensor_list .= '<div class="panel panel-default">' . "\n";
		$html_sensor_list .= '<div class="panel-heading">Sensor ' . ($i+1) . ' Specifics</div>' . "\n";
		$html_sensor_list .= '<div class="panel-body">' . "\n";
		$html_sensor_list .= '<div class="row">' . "\n";

				//---------------------Name---------------------//

			$html_sensor_list .= '<div class="col-lg-4">' . "\n";

					$html_sensor_list .= '<p style="font-weight:bold;"> Sensor Name </p>' . "\n";
					$html_sensor_list .= '<input type="text" class="form-control" name="name' . ($i+1) . '" placeholder="Name" value="' . $SENSOR_INFO[$i]->name . '">' . "\n";
				$html_sensor_list .= '<br>' . "\n";

			$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";
				
				//------------------i2c address-------------------//

			$html_sensor_list .= '<div class="col-lg-4">' . "\n";

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
				
				include 'analysisType.php';

			$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";

			//------------------------Threshold-------------------------//

			$html_sensor_list .= '<div class="col-lg-4">' . "\n";

				include 'threshold.php';

			$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";


		//----------------------------Divider---------------------------//

		$html_sensor_list .= '</div> <!-- row -->' . "\n";	
		$displayString = "";
		if ($SENSOR_INFO[$i]->analysis == "On-Peak Off-Peak %"){
			$displayString = ' style="display:none;"';
		}
		$html_sensor_list .= '<div id="binInformation' . ($i+1) . '"' . $displayString . '>' . "\n";
		$html_sensor_list .= '<hr style="border:none; height:1px; background-color:#DDDDDD;">' . "\n";
		$html_sensor_list .= '<div class="row">' . "\n";
			

			//--------------------------Bin Type------------------------//

			$html_sensor_list .= '<div class="col-lg-4">' . "\n";
				
				include 'binType.php';

			$html_sensor_list .= '</div> <!--col-lg-4-->' . "\n";

		//---------------Shift Down---------------------//

		$html_sensor_list .= '</div> <!--row-->' . "\n";
		$html_sensor_list .= '<div class="row">' . "\n";
			$html_sensor_list .= '<div class="col-lg-1"></div>' . "\n";
			$displayString = "";
			if ($SENSOR_INFO[$i]->binType != "From Sensor"){
				$displayString = 'style="display:none"';
			}
			$html_sensor_list .= '<div class="col-lg-5" id="fromSensorBlock' . ($i+1) .'"' . $displayString . '>' . "\n";
				$html_sensor_list .= '<div class="row">' . "\n";
					$html_sensor_list .= '<p style="font-weight:bold;"> From Sensor: </p>' . "\n";
													
						//------------------------From Sensor Number-----------------------//

						$html_sensor_list .= '<div class="col-lg-5">' . "\n";

							include 'fromSensorNumber.php';

						$html_sensor_list .= '</div> <!--col-lg-5-->' . "\n";

						//---------------------------From Sensor Threshold Min and Max-------------------------//

						$html_sensor_list .= '<div class="col-lg-5">' . "\n";

							include 'fromSensorThreshold.php';

						$html_sensor_list .= '</div> <!-- col-lg-5 -->' . "\n";

						//--------------- Move to next column --------------------//

					$html_sensor_list .= '<br>' . "\n";
					$html_sensor_list .= '</div> <!-- row -->' . "\n";
				$html_sensor_list .= '</div> <!-- col-lg-5 -->' . "\n";

				// -------------------Custom Time Information--------------------//

				$displayString = "";
				if ($SENSOR_INFO[$i]->binType != "Custom Time"){
					$displayString = 'style="display:none;"';
				}
				$html_sensor_list .= '<div id="customTimeBlock' . ($i+1) . '"' . $displayString . '>' . "\n";
				$html_sensor_list .= '<div class="col-lg-4">' . "\n";
					$html_sensor_list .= '<div class="row">' . "\n";
					$html_sensor_list .= '<p style="font-weight:bold; margin:0px 0px 0px;"> Custom Time Range: </p>' . "\n";

					//--------------------------Custom Time Peak Hour Start and Stop------------------------//

					$html_sensor_list .= '<div class="col-lg-6">' . "\n";
						
						include 'customTime.php';

					$html_sensor_list .= '</div> <!-- col-lg-6 -->' . "\n";

					//--------------------------Custom Time Days-----------------------------//

					$html_sensor_list .= '<div class="col-lg-6">' . "\n";

						include 'customTimeDays.php';

					$html_sensor_list .= '</div> <!-- col-lg-6 -->' . "\n";

					//-------------------- Move to Next Column---------------------//

				$html_sensor_list .= '</div> <!-- row -->' . "\n";
			$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";
			$html_sensor_list .= '<div class="col-lg-3">' . "\n";
				$html_sensor_list .= '<div class="row">' . "\n";
					
					//----------------------------Summary Method----------------------------//

					$html_sensor_list .= '<div class="col-lg-10">' . "\n";

						include 'summaryMethod.php';

					$html_sensor_list .= '</div> <!-- col-lg-10 -->' . "\n";


				$html_sensor_list .= '</div> <!-- row -->' . "\n";
			$html_sensor_list .= '</div> <!-- col-lg-3 -->' . "\n";
			$html_sensor_list .= '</div> <!-- Custom Time Block -->' . "\n";
		$html_sensor_list .= '</div> <!-- row -->' . "\n";
		$html_sensor_list .= '</div> <!-- binInformation -->' . "\n";
		$html_sensor_list .= '</div> <!-- panel-body -->' . "\n";
	$html_sensor_list .= '</div> <!-- panel panel-default -->' . "\n";
	$html_sensor_list .= '<button onclick="loadAndAlert()" style="margin-left:auto; margin-right:auto;" type="submit" form="sensorSpecifics" class="btn btn-primary btn-block" name= "sensorInfo">Submit</button>' . "\n";
	$html_sensor_list .= '<br>' . "\n";
}
$html_sensor_list .= '</form>' . "\n";
$html_sensor_list .= '<button type="button" onclick="window.location.href=window.location.href" class="btn btn-primary btn-block">Display Updates!</button>' . "\n";
echo $html_sensor_list;

?>