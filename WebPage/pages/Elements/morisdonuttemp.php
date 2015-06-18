new Morris.Donut({
	element: 'summary-bar-chart-<?php echo $graphnum ?>',
	data: 	<?php
			$filename = $Summary_Base . "Temperature" . '/' . $year_file;
			$lines = file($filename);
			$percentGood = 0;
			$percentBad = 0;
			$monthCount = 0;
			foreach($lines as $line){
				if(substr($line, 0, 1) == "#"){} 
				else{
                                	list($pi_id, $sensor_id, $sensor_name, $summary_year, $month, $max_day_temp, $max_night_temp, $min_day_temp, $min_night_temp, $time_inRange_day, $time_inRange_night) = explode(',', $line);
						if ($time_inRange_day != '0.00'){
							$time_notinRange_day = 100 - (float) $time_inRange_day;
							$percentBad += $time_notinRange_day;
						}
						$percentGood += $time_inRange_day;
				}
			}
			$data = '[{label: "' . '% Time in Range (day)", value:' . $percentGood . '}, {label: "% Time not in Range (day)", value:' . $percentBad . '}]';
			echo $data;
		?>
	});