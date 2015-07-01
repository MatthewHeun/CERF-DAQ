<!-- /.YEAR SENSOR 1 panel -->
                    
<?php
	$i = 1;
	while ($i <= $NUM_SENSORS){
		$year_file = "Pi_" . $PI_NUMBER . "_" . $i . "_" . $year_sum . ".csv";
		$pageSensor = $SENSOR_INFO[$i-1]->name;
		if ($SENSOR_INFO[$i-1]->analysis == "Peak"){
			include 'Elements/barchartpeak.php'; 
		} elseif ($SENSOR_INFO[$i-1]->analysis == "Min-Max"){
			include 'Elements/barchartmin-max-ave.php'; 
		} elseif ($SENSOR_INFO[$i-1]->analysis == "Bins"){
			include 'Elements/barchartbins.php';
		}
		$i = $i + 1;
		$graphnum = $graphnum + 1;
		$sensor_number = $sensor_number + 1;
	}
?>





