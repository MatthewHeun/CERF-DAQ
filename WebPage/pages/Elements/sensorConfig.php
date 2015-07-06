<?php include '../global_vars.php' . "\n"; ?>
<?php
$pageLink = 'configuration.php' . "\n";
$html_sensor_list = '<form action="configuration.php" id="sensorSpecifics" method="get">' . "\n";
for ($i=0; $i < $NUM_SENSORS; $i++){
	$html_sensor_list .= '<div class="panel panel-default">' . "\n";
		$html_sensor_list .= '<div class="panel-heading">Sensor ' . ($i+1) . ' Specifics</div>' . "\n";
		$html_sensor_list .= '<div class="panel-body">' . "\n";
		$html_sensor_list .= '<div class="row">' . "\n";

			$html_sensor_list .= '<div class="col-lg-4">' . "\n";

					$html_sensor_list .= '<p style="font-weight:bold;"> Sensor Name </p>' . "\n";
					$html_sensor_list .= '<input type="text" class="form-control" name="name' . ($i+1) . '" placeholder="Name" value="' . $SENSOR_INFO[$i]->name . '">' . "\n";
				$html_sensor_list .= '<br>' . "\n";
				$html_sensor_list .= '<p style="font-weight:bold;"> i2c Address </p>' . "\n";

				//------------------i2c address-------------------//

				$html_sensor_list .= '<select class="form-control" name ="i2c' . ($i+1) . '">' . "\n";
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
				$html_sensor_list .= '</select>' . "\n";
				
				$html_sensor_list .= '<br>' . "\n";

			$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";
			$html_sensor_list .= '<div class="col-lg-4">' . "\n";

				//------------------------Sensor Type-----------------------//

				$html_sensor_list .= '<p style="font-weight:bold;"> Sensor Type </p>' . "\n";
				$html_sensor_list .= '<select class="form-control" name="sensor' . ($i+1) .'type">' . "\n";
				$html_sensor_list .= '<br>' . "\n";
				if ($SENSOR_INFO[$i]->type == "Light"){
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

				//----------------------pinNumber---------------------//

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


			$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";
			$html_sensor_list .= '<div class="col-lg-4">' . "\n";

			//--------------------------Analysis Type------------------------//

				$html_sensor_list .= '<p style="font-weight:bold;"> Analysis Type </p>' . "\n";
				$html_sensor_list .= '<select class="form-control" name="analysis' . ($i+1) .'type">' . "\n";
				$html_sensor_list .= '<br>' . "\n";
				if ($SENSOR_INFO[$i]->analysis == "Peak"){
					$html_sensor_list .= '<option selected="selected">Peak</option>' . "\n";
				} else {
					$html_sensor_list .= '<option>Peak</option>' . "\n";
				}
				if ($SENSOR_INFO[$i]->analysis == "Min-Max"){
					$html_sensor_list .= '<option selected="selected">Min-Max</option>' . "\n";
				} else {
					$html_sensor_list .= '<option>Min-Max</option>' . "\n";
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
		$html_sensor_list .= '</div> <!-- row -->' . "\n";	
		$html_sensor_list .= '<hr style="border:none; height:1px; background-color:#DDDDDD;">' . "\n";
		$html_sensor_list .= '<div class="row">' . "\n";
			$html_sensor_list .= '<div class="col-lg-4">' . "\n";

			//--------------------------Bin Type------------------------//

				$html_sensor_list .= '<p style="font-weight:bold;"> Bin Characteristics </p>' . "\n";
				$html_sensor_list .= '<select class="form-control" name="binType' . ($i+1) . '">' . "\n";
				$html_sensor_list .= '<br>' . "\n";
				if ($SENSOR_INFO[$i]->binType == "Year"){
					$html_sensor_list .= '<option selected="selected">Year</option>' . "\n";
				} else {
					$html_sensor_list .= '<option>Year</option>' . "\n";
				}
				if ($SENSOR_INFO[$i]->binType == "Month"){
					$html_sensor_list .= '<option selected="selected">Month</option>' . "\n";
				} else {
					$html_sensor_list .= '<option>Month</option>' . "\n";
				}
				if ($SENSOR_INFO[$i]->binType == "Day"){
					$html_sensor_list .= '<option selected="selected">Day</option>' . "\n";
				} else {
					$html_sensor_list .= '<option>Day</option>' . "\n";
				}
				if ($SENSOR_INFO[$i]->binType == "From Sensor"){
					$html_sensor_list .= '<option selected="selected">From Sensor</option>' . "\n";
				} else {
					$html_sensor_list .= '<option>From Sensor</option>' . "\n";
				}
				if ($SENSOR_INFO[$i]->binType == "Custom Time"){
					$html_sensor_list .= '<option selected="selected">Custom Time</option>' . "\n";
				} else {
					$html_sensor_list .= '<option>Custom Time</option>' . "\n";
				}
				$html_sensor_list .= '</select>' . "\n";
				$html_sensor_list .= '<br>' . "\n";


			$html_sensor_list .= '</div> <!--col-lg-4-->' . "\n";
		$html_sensor_list .= '</div> <!--row-->' . "\n";
		$html_sensor_list .= '<div class="row">' . "\n";
			$html_sensor_list .= '<div class="col-lg-5">' . "\n";
				$html_sensor_list .= '<div class="row">' . "\n";
					$html_sensor_list .= '<div style="margin-left:5%;">' . "\n";
					$html_sensor_list .= '<p style="font-weight:bold;"> From Sensor: </p>' . "\n";
					$html_sensor_list .= '<div style="margin-left:5%;">' . "\n";
						$html_sensor_list .= '<div class="col-lg-5">' . "\n";
							
							//------------------------From Sensor Number-----------------------//

							$html_sensor_list .= '<p style="font-weight:bold;"> Sensor Number </p>' . "\n";
							$html_sensor_list .= '<select class="form-control" name="fromSensorNumber' . ($i+1) . '">' . "\n";
								$options = "";
								$i2 = 1;
								while ($i2 < $NUM_SENSORS) {
									if ($i2 == $SENSOR_INFO->fromSensorNumber) {
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

						$html_sensor_list .= '</div> <!--col-lg-5-->' . "\n";
						$html_sensor_list .= '<div class="col-lg-5">' . "\n";

							//---------------------------From Sensor Threshold Min and Max-------------------------//

							$html_sensor_list .= '<p style="font-weight:bold;"> Threshold Min </p>' . "\n";
							$html_sensor_list .= '<input type="text" class="form-control" name="fromSensorMin' . ($i+1) . '" placeholder="min" value="' . $SENSOR_INFO[$i]->thresholdMin .'">' . "\n";
							$html_sensor_list .= '<br>' . "\n";
							$html_sensor_list .= '<p style="font-weight:bold;"> Threshold Max </p>' . "\n";
							$html_sensor_list .= '<input type="text" class="form-control" name="fromSensorMax' . ($i+1) . '" placeholder="max" value="' . $SENSOR_INFO[$i]->thresholdMax . '">' . "\n";
						

						$html_sensor_list .= '</div> <!-- col-lg-5 -->' . "\n";
					$html_sensor_list .= '</div> <!-- margin-left:5% -->' . "\n";
					$html_sensor_list .= '</div> <!-- margin-left:5% -->' . "\n";
					$html_sensor_list .= '<br>' . "\n";
					$html_sensor_list .= '</div> <!-- row -->' . "\n";
			$html_sensor_list .= '</div> <!-- col-lg-5 -->' . "\n";
				$html_sensor_list .= '<div class="col-lg-4">' . "\n";
					$html_sensor_list .= '<div class="row">' . "\n";
					$html_sensor_list .= '<p style="font-weight:bold; margin:0px 0px 0px;"> Custom Time: </p>' . "\n";
						$html_sensor_list .= '<div class="col-lg-6">' . "\n";

							//--------------------------Custom Time Peak Hour Start and Stop------------------------//
							$html_sensor_list .= '<p style="font-weight:bold; margin:10px 0px;"> Start Hour </p>' . "\n";
							$html_sensor_list .= '<select class="form-control" name="customStart' . ($i+1) .'">' . "\n";
							$html_sensor_list .= '<br>' . "\n";

							$options = "";
								$i2 = 0;
								while ($i2 < 24) {
									if ($i2 == $SENSOR_INFO[$i]->customStart) {
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
							$html_sensor_list .= '<select class="form-control" name="customStop' . ($i+1) .'">' . "\n";
							$html_sensor_list .= '<br>' . "\n";

							$options = "";
								$i2 = 0;
								while ($i2 < 24) {
									if ($i2 == $SENSOR_INFO[$i]->customStop) {
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
							$html_sensor_list .= '</div> <!-- col-lg-6 -->' . "\n";
							$html_sensor_list .= '<div class="col-lg-6">' . "\n";

							//--------------------------Custom Time Days-----------------------------//

							$html_sensor_list .= '<p style="font-weight:bold;"> Days: </p>' . "\n";
							$html_sensor_list .= '<div class="container">' . "\n";
							$html_sensor_list .= '<input type="checkbox" name="M' . ($i+1) . '" value="M"';
							if ($SENSOR_INFO[$i]->M == "M"){ $html_sensor_list .= ' tabindex="checked"'; }
							$html_sensor_list .= '> M<br>' . "\n";
							$html_sensor_list .= '<input type="checkbox" name="T' . ($i+1) . '" value="T"';
							if ($SENSOR_INFO[$i]->M == "M"){ $html_sensor_list .= ' tabindex="checked"'; }
							$html_sensor_list .= '> T<br>' . "\n";
							$html_sensor_list .= '<input type="checkbox" name="W' . ($i+1) . '" value="W"';
							if ($SENSOR_INFO[$i]->M == "M"){ $html_sensor_list .= ' tabindex="checked"'; }
							$html_sensor_list .= '> W<br>' . "\n";
							$html_sensor_list .= '<input type="checkbox" name="Th' . ($i+1) . '" value="Th"';
							if ($SENSOR_INFO[$i]->M == "M"){ $html_sensor_list .= ' tabindex="checked"'; }
							$html_sensor_list .= '> Th<br>' . "\n";
							$html_sensor_list .= '<input type="checkbox" name="F' . ($i+1) . '" value="F"';
							if ($SENSOR_INFO[$i]->M == "M"){ $html_sensor_list .= ' tabindex="checked"'; }
							$html_sensor_list .= '> F<br>' . "\n";
							$html_sensor_list .= '<input type="checkbox" name="Sa' . ($i+1) . '" value="Sa"';
							if ($SENSOR_INFO[$i]->M == "M"){ $html_sensor_list .= ' tabindex="checked"'; }
							$html_sensor_list .= '> Sa<br>' . "\n";
							$html_sensor_list .= '<input type="checkbox" name="Su' . ($i+1) . '" value="Su" style="margin:4px 0px 14px;"';
							if ($SENSOR_INFO[$i]->M == "M"){ $html_sensor_list .= ' tabindex="checked"'; }
							$html_sensor_list .= '> Su<br>' . "\n";
							$html_sensor_list .= '</div> <!-- container -->' . "\n";


						$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";
				$html_sensor_list .= '</div> <!-- row -->' . "\n";
			$html_sensor_list .= '</div> <!-- col-lg-4 -->' . "\n";
			$html_sensor_list .= '<div class="col-lg-3">' . "\n";
				$html_sensor_list .= '<div class="row">' . "\n";


					//----------------------------Summary Method----------------------------//

					$html_sensor_list .= '<p style="font-weight:bold;"> Summary Format: </p>' . "\n";
					$html_sensor_list .= '<select class="form-control" name="summaryFormat' . ($i+1) . '">' . "\n";
					$html_sensor_list .= '<br>' . "\n";
					if ($SENSOR_INFO[$i]->binType == "Year"){
						$html_sensor_list .= '<option selected="selected">Year</option>' . "\n";
					} else {
						$html_sensor_list .= '<option>Year</option>' . "\n";
					}
					if ($SENSOR_INFO[$i]->binType == "Month"){
						$html_sensor_list .= '<option selected="selected">Month</option>' . "\n";
					} else {
						$html_sensor_list .= '<option>Month</option>' . "\n";
					}
					if ($SENSOR_INFO[$i]->binType == "Day"){
						$html_sensor_list .= '<option selected="selected">Day</option>' . "\n";
					} else {
						$html_sensor_list .= '<option>Day</option>' . "\n";
					}
					if ($SENSOR_INFO[$i]->binType == "From Sensor"){
						$html_sensor_list .= '<option selected="selected">From Sensor</option>' . "\n";
					} else {
						$html_sensor_list .= '<option>From Sensor</option>' . "\n";
					}
					if ($SENSOR_INFO[$i]->binType == "Custom Time"){
						$html_sensor_list .= '<option selected="selected">Custom Time</option>' . "\n";
					} else {
						$html_sensor_list .= '<option>Custom Time</option>' . "\n";
					}
					$html_sensor_list .= '</select>' . "\n";
					$html_sensor_list .= '<br>' . "\n";
						
				$html_sensor_list .= '</div> <!-- row -->' . "\n";
			$html_sensor_list .= '</div> <!-- col-lg-3>' . "\n";
		$html_sensor_list .= '</div> <!-- row -->' . "\n";
		$html_sensor_list .= '</div> <!-- panel-body -->' . "\n";
		$html_sensor_list .= '</div> <!-- panel heading -->' . "\n";
	$html_sensor_list .= '</div> <!-- panel panel-default -->' . "\n";
}
$html_sensor_list .= '</form>' . "\n";
$html_sensor_list .= '<button onclick="loadAndAlert()" style="margin-left:auto; margin-right:auto;" type="submit" form="sensorSpecifics" class="btn btn-primary btn-block" name= "sensorInfo">Submit</button>' . "\n";
$html_sensor_list .= '<br>' . "\n";
$html_sensor_list .= '<button type="button" onclick="window.location.href=window.location.href" class="btn btn-primary btn-block">Display Updates!</button>' . "\n";
echo $html_sensor_list;

?>