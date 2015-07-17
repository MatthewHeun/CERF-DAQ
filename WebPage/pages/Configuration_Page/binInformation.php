<?php
		
		$displayString = "";
		if ($SENSOR_INFO[$i]->numberOfAnalysis < $i3){
			$displayString = ' style="display:none;"';
		}
		$html_sensor_list .= '<div id="analysisInformation' . ($i3) . ($i+1) . '" ' . $displayString . '>' . "\n";
		$html_sensor_list .= '<hr style="border:none; height:1px; background-color:#DDDDDD;">' . "\n";
		$html_sensor_list .= '<div class="row">' . "\n";
			
			//-----------------------Analysis Type----------------------//

			$html_sensor_list .= '<div class="col-lg-4">' . "\n";

				include 'analysisType.php';

			$html_sensor_list .= '</div> <!--col-lg-4-->' . "\n";

			//--------------------------Bin Type------------------------//

			$displayString = '';
				if ($SENSOR_INFO[$i]->analysis[$i3-1] == "On-Peak Off-Peak %"){
					$displayString = ' style="display:none;"';
				}

			$html_sensor_list .= '<div class="col-lg-4" id="binInformation' . ($i3) . ($i+1) . '" ' . $displayString . '>' . "\n";
				
				include 'binType.php';

			$html_sensor_list .= '</div> <!--col-lg-4-->' . "\n";

		//---------------Shift Down---------------------//

		$html_sensor_list .= '</div> <!--row-->' . "\n";

		$displayString = '';
		if ($SENSOR_INFO[$i]->analysis[$i3-1] == "On-Peak Off-Peak %"){
			$displayString = ' style="display:none;"';
		}

		$html_sensor_list .= '<div class="row" id="binSpecifics' . ($i3) . ($i+1) . '" ' . $displayString . '>' . "\n";
			$html_sensor_list .= '<div class="col-lg-1"></div>' . "\n";

			$displayString = "";
			if ($SENSOR_INFO[$i]->binType[$i3-1] != "From Sensor"){
				$displayString = 'style="display:none"';
			}

			$html_sensor_list .= '<div class="col-lg-5" id="fromSensorBlock' . ($i3) . ($i+1) .'" ' . $displayString . '>' . "\n";
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
				if ($SENSOR_INFO[$i]->binType[$i3-1] != "Custom Time"){
					$displayString = 'style="display:none;"';
				}
				$html_sensor_list .= '<div id="customTimeBlock' . ($i3) . ($i+1) . '" ' . $displayString . '>' . "\n";
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

								//------------------------Threshold-------------------------//

				$html_sensor_list .= '<div class="col-lg-10">' . "\n";

					include 'threshold.php';

				$html_sensor_list .= '</div> <!-- col-lg-10 -->' . "\n";

				$html_sensor_list .= '</div> <!-- row -->' . "\n";
			$html_sensor_list .= '</div> <!-- col-lg-3 -->' . "\n";
			$html_sensor_list .= '</div> <!-- Custom Time Block -->' . "\n";
		$html_sensor_list .= '</div> <!-- row -->' . "\n";
		$html_sensor_list .= '</div> <!-- analysisInformation -->' . "\n";

?>