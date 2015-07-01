new Morris.Donut({
	element: 'donut-night-<?php echo $graphnum ?>',
	data: 	<?php
			$filename = $Summary_Base . "Min-Max" . '/' . $year_file;
			$lines = file($filename);
			$percentGood = 0;
			$percentBad = 0;
			$monthCount = 0;
			foreach($lines as $line){
				if(substr($line, 0, 1) == "#"){} 
				else {
                                	list($pi_id, $sensor_id, $sensor_name, $summary_year, $month, $max_day_temp, $max_night_temp, $min_day_temp, $min_night_temp, $time_inRange_day, $time_inRange_night) = explode(',', $line);
					if (($time_inRange_day == '0.00') and ($time_inRange_night == "0.00\n")){}							
					else {	
						$time_notinRange_night = 100 - (float) $time_inRange_night;
						$percentBad += (float) $time_notinRange_night;
						$monthCount += 1;
						$percentGood += (float) $time_inRange_night;
					}
				}
			}
			if (($monthCount == 0)){
				$percentGood = 0;
				$percentBad = 100;
			} else {
				$percentGood = $percentGood / $monthCount;
				$percentBad = $percentBad / $monthCount;
			}
			$data = '[{label: "' . '% Time in Range (night)", value:' . $percentGood . '}, {label: "% Time not in Range (night)", value:' . $percentBad . '}],';
			echo $data;
		?>
	colors: ['#0B62A4','#CCCCCC']
	});