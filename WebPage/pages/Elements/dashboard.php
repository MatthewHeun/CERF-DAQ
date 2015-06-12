<!-- /.YEAR SENSOR 1 panel -->
                    
<?php
	$i = 1;
	while ($i <= $NUMBER_OF_SENSORS){
		$year_file = "Pi_" . $Pi_Number . "_" . $i . "_" . $year_sum . ".csv";
		$pageSensor = $SENSOR_NAMES[$i - 1];
		if ($SENSOR_TYPES[$sensor_number - 1] == "Light"){
			include 'Elements/barchartlight.php'; 
		} elseif ($SENSOR_TYPES[$sensor_number - 1] == "Temperature"){
			include 'Elements/barcharttemp.php'; 
		} elseif ($SENSOR_TYPES[$sensor_number - 1] == "Occupancy"){
			include 'Elements/barchartlight.php';
		}
		$i = $i + 1;
		$graphnum = $graphnum + 1;
		$sensor_number = $sensor_number + 1; 
	}
?>

