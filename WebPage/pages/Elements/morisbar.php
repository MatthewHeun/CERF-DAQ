new Morris.Bar({
        	element: 'summary-bar-chart-<?php echo $graphnum . '-' . ($k+1) ?>',
         	data: <?php
					$filename = ($Summary_Base . $summary_file . 'a' . ($k+1) . '.csv');
					$lines = file($filename);
					$data = '[';
					$IndexToMonth = array("01" => "Jan", "02" => "Feb", "03" => "Mar", "04" => "Apr", "05" => "May", "06" => "Jun", "07" => "Jul", "08" => "Aug", "09" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");
                                        foreach($lines as $line){
						if(substr($line, 0, 1) == "#"){
						}else{
                            list($pi_id, $sensor_id, $sensor_name, $summary_year, $month, $on, $off) = explode(',', $line);
							$monthstring = $IndexToMonth[$month];
							if ($summary_year == $year_sum){
								$data .= "{y: '$monthstring', a: $on, b: $off},";
							}
						}
					}
					$data = rtrim($data, ',');
					$data .= '],';
					echo $data;
				?> 
        	xkey: 'y',
        	ykeys: ['a', 'b'],
        	labels: ['On Peak %', 'Off Peak %'],
        	hideHover: false,
		xLabelMargin: 10,
		grid: false,
        	resize: true
    	});
