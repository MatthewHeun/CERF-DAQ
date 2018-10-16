<?php

if(isset($_GET['submitSensors'])){
		$numSensors = $_GET['numSensors'];
		$file = fopen("numSensors.txt", "w");
		fwrite($file, $numSensors);
}

?>