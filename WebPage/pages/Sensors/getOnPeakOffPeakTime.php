<?php

$peakWeekday = new ArrayObject(array());

if(isset($_GET['peakStart'])){
		$file = fopen("onPeakOffPeakTime.txt", "w");
		
		$peakStart = $_GET['peakStart'];
		fwrite($file, $peakStart . "\n");
		
		$peakStop = $_GET['peakStop'];
		fwrite($file, $peakStop . "\n");

		$peakWeekday->append($_GET['M']);
		fwrite($file, $peakWeekday[0] . "\n");

		$peakWeekday->append($_GET['Tu']);
		fwrite($file, $peakWeekday[1] . "\n");

		$peakWeekday->append($_GET['W']);
		fwrite($file, $peakWeekday[2] . "\n");

		$peakWeekday->append($_GET['Th']);
		fwrite($file, $peakWeekday[3] . "\n");

		$peakWeekday->append($_GET['F']);
		fwrite($file, $peakWeekday[4] . "\n");

		$peakWeekday->append($_GET['Sa']);
		fwrite($file, $peakWeekday[5] . "\n");

		$peakWeekday->append($_GET['Su']);
		fwrite($file, $peakWeekday[6] . "\n");
}

?>