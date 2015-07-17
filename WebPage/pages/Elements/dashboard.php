<!-- /.YEAR SENSOR 1 panel -->
                    
<?php
	$i = 1;
	while ($i <= $NUM_SENSORS){
		$summary_file = "Pi_" . $PI_NUMBER . "_" . $i . ".csv";
		$pageSensor = $SENSOR_INFO[$i-1]->name;
		if ($SENSOR_INFO[$i-1]->analysis == "On-Peak Off-Peak %"){
			include 'Elements/barchartpeak.php'; 
		} elseif ($SENSOR_INFO[$i-1]->analysis == "Min-Max" or $SENSOR_INFO[$i-1]->analysis == "Range Analysis"){
			include 'Elements/barchart.php'; 
		} elseif ($SENSOR_INFO[$i-1]->analysis == "kWh"){
			include 'Elements/barchartbins.php';
		}
		$i = $i + 1;
		$graphnum = $graphnum + 1;
		$sensor_number = $sensor_number + 1;
	}
?>





