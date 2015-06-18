<?php

if(isset($_GET['submitSensors'])){
		$numLightSensors = $_GET['numLightSensors'];
		$file = fopen("numLightSensors.txt", "w");
		fwrite($file, $numLightSensors);
}

?>