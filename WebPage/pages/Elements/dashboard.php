<!-- /.YEAR SENSOR 1 panel -->
                    
<?php
	$sensors = array($SENSOR1, $SENSOR2, $SENSOR3, $SENSOR4, $SENSOR5, $SENSOR6, $SENSOR7, $SENSOR8, $SENSOR9, $SENSOR10, $SENSOR11, $SENSOR12, $SENSOR13, $SENSOR14, $SENSOR15, $SENSOR16);
	$i = 1;
	while ($i <= $NUMBER_OF_SENSORS){
		$year_file = "Pi_" . $Pi_Number . "_" . $i . "_" . $year_sum . ".csv";
		$pageSensor = $sensors[$i - 1];
		include 'Elements/barchart.php'; 
		$i = $i + 1;
		$graphnum = $graphnum + 1;
		$sensor_number = $sensor_number + 1; 
	}
?>

