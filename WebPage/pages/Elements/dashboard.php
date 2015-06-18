<!-- /.YEAR SENSOR 1 panel -->
                    
<?php
	$i = 1;
	while ($i <= $NUMBER_OF_SENSORS){
		$year_file = "Pi_" . $Pi_Number . "_" . $i . "_" . $year_sum . ".csv";
		$pageSensor = $SENSOR_NAMES[$i - 1];
		if ($ANALYSIS_TYPES[$sensor_number - 1] == "on/off-peak"){
			include 'Elements/barchartpeak.php'; 
		} elseif ($ANALYSIS_TYPES[$sensor_number - 1] == "min-max-ave"){
			include 'Elements/barchartmin-max-ave.php'; 
		} elseif ($ANALYSIS_TYPES[$sensor_number - 1] == "bins"){
			include 'Elements/barchartbins.php';
		}
		$i = $i + 1;
		$graphnum = $graphnum + 1;
		$sensor_number = $sensor_number + 1;
	}
?>





