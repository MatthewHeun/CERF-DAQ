<!-- /.YEAR SENSOR 1 panel -->
                    
<?php
	$i = 1;
	while ($i <= $NUM_SENSORS){
		for ($k=0; $k<$SENSOR_INFO[$i-1]->numberOfAnalysis; $k++){
			$summary_file = "Pi_" . $PI_NUMBER . "_" . $i;
			$pageSensor = $SENSOR_INFO[$i-1]->name;
			$sensor_number = $SENSOR_INFO[$i-1]->number;
			if ($SENSOR_INFO[$i-1]->analysis[$k] == "On-Peak Off-Peak %"){
				include 'Elements/barchartpeak.php'; 
			} elseif ($SENSOR_INFO[$i-1]->analysis[$k] == "Min-Max" or $SENSOR_INFO[$i-1]->analysis[$k] == "Range Analysis"){
				include 'Elements/barchart.php'; 
			} elseif ($SENSOR_INFO[$i-1]->analysis[$k] == "kWh"){
				include 'Elements/barchartbins.php';
			}
		}
		$i = $i + 1;
		$graphnum = $graphnum + 1;
		$sensor_number = $sensor_number + 1;
	}
?>





