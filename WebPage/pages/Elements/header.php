<?php
	$year = date("Y");
	$year_sum = date("Y");
	$month = date("m");
	$day = date("Y-m-d");
	if(isset($_GET['Year'])){
		$year_sum = $_GET['Year'];
	}
	if(isset($_GET['Day'])){
		$day = $_GET['Day'];
		$month = substr($day, 5, 2);
		$year = substr($day, 0, 4);
	}
	$day_alone = substr($day, -2, 2);
	$today_string = $month . "/" . $day_alone . "/" . $year;
	$current = new DateTime($today_string);
	$nextDay = new DateTime($today_string);
	date_modify($nextDay, '+1 day');
	$prevDay = new DateTime($today_string);
	date_modify($prevDay, '-1 day');
	$next = date_format($nextDay, 'Y-m-d');
	$prev = date_format($prevDay, 'Y-m-d');

	$nextYear = $year_sum+1;
	$prevYear = $year_sum-1;

    $day_file = "Sensor" . $sensor_number . "/" . $year . "/" . $month . "/Pi_" . $PI_NUMBER . "_" . $sensor_number . "_" . $day . ".csv";
    $summary_file = "Pi_" . $PI_NUMBER . "_" . $sensor_number;
	$graphnum = 1;
	$Summary_Base= "../../../Data/Pi_" . $PI_NUMBER . "_Summary/";
	$Raw_Base= "../../../Data/Pi_" . $PI_NUMBER . "_Raw/";

	include 'Elements/createJavascript.php';
?>
