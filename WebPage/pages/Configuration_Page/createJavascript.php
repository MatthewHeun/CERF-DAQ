<?php

$javaFile = fopen("/home/pi/Desktop/CERF-DAQ/WebPage/js/submit_javascript.js", "w");

for ($i = 0; $i < $NUM_SENSORS; $i++){
		$fileString = 'function toggleDisplay' . ($i+1) . '() {' . "\n";
		$fileString .= 'if (document.getElementById("panelBody' . ($i+1) . '").style.display == "none") {' . "\n";
		$fileString .= 'document.getElementById("panelBody' . ($i+1) . '").style.display = "block";' . "\n";
		$fileString .= 'document.getElementById("submit' . ($i+1) . '").style.display = "block";' . "\n";
		$fileString .= '} else {' . "\n";
		$fileString .= 'document.getElementById("panelBody' . ($i+1) . '").style.display = "none";' . "\n";
		$fileString .= 'document.getElementById("submit' . ($i+1) . '").style.display = "none";' . "\n";
		$fileString .= '}' . "\n";
		$fileString .= '}' . "\n" . "\n";
		fwrite($javaFile, $fileString);
}

for ($i = 0; $i < $NUM_SENSORS; $i++){
		fwrite($javaFile, '$("#sensorType');
		$fileString = ($i+1) . '").change(function() {' . "\n";
		$fileString .= 'var sensorType = ';
		fwrite($javaFile, $fileString);
		fwrite($javaFile, '$("#sensorType');
			$fileString =  ($i+1) . '").val();' . "\n";
			$fileString .= 'console.log(sensorType);' . "\n";
			$fileString .= 'console.log("sensor type");' . "\n";
			$fileString .= 'if (sensorType == \'Occupancy\'){' . "\n";
				$fileString .= 'document.getElementById("i2cAddress' . ($i+1) . '").style.display = "none";' . "\n";
				$fileString .= 'document.getElementById("voltage' . ($i+1) . '").style.display = "none";' . "\n";
			$fileString .= '} else if (sensorType == \'Current\'){' . "\n";
				$fileString .= 'document.getElementById("voltage' . ($i+1) . '").style.display = "block";' . "\n";
				$fileString .= 'document.getElementById("i2cAddress' . ($i+1) . '").style.display = "none";' . "\n";
			$fileString .= '} else {' . "\n";
				$fileString .= 'document.getElementById("i2cAddress' . ($i+1) . '").style.display = "block";' . "\n";
				$fileString .= 'document.getElementById("voltage' . ($i+1) . '").style.display = "none";' . "\n";
			$fileString .= '}' . "\n";
		$fileString .= '} );' . "\n" . "\n";
		fwrite($javaFile, $fileString);
}

for ($i = 0; $i < $NUM_SENSORS; $i++){
	for ($i5 = 0; $i5 < 3; $i5++){
		fwrite($javaFile, '$("#numAnalysis');
		$fileString = $i+1 . '").change(function() {' . "\n";
		$fileString .= 'var numberOfAnalysis = ';
		fwrite($javaFile, $fileString);
		fwrite($javaFile, '$("#numAnalysis');
			$fileString =  $i+1 . '").val();' . "\n";
			$fileString .= 'console.log(numberOfAnalysis);' . "\n";
			$fileString .= 'console.log("number of analysis");' . "\n";
			$fileString .= 'if (parseInt(numberOfAnalysis) > ' . $i5 . '){' . "\n";
				$fileString .= 'document.getElementById("analysisInformation' . ($i5+1) . ($i+1) . '").style.display = "block";' . "\n";
			$fileString .= '} else {' . "\n";
				$fileString .= 'document.getElementById("analysisInformation' . ($i5+1) . ($i+1) . '").style.display = "none";' . "\n";
			$fileString .= '}' . "\n";
		$fileString .= '} );' . "\n" . "\n";
		fwrite($javaFile, $fileString);
	}
}

for ($i = 0; $i < $NUM_SENSORS; $i++){
	for ($i5 = 0; $i5 < 3; $i5++){
		fwrite($javaFile, '$("#analysis');
		$fileString = $i5+1 . $i+1 . '").change(function() {' . "\n";
		$fileString .= 'var analysis = ';
		fwrite($javaFile, $fileString);
		fwrite($javaFile, '$("#analysis');
			$fileString =  $i5+1 . $i+1 . '").val();' . "\n";
			$fileString .= 'console.log(analysis);' . "\n";
			$fileString .= 'console.log("analysis type");' . "\n";
			$fileString .= 'console.log(analysis=="On-Peak Off-Peak %");' . "\n";
			$fileString .= 'if (analysis == "On-Peak Off-Peak %"){' . "\n";
				$fileString .= 'document.getElementById("binInformation' . ($i5+1) . ($i+1) . '").style.display = "none";' . "\n";
				$fileString .= 'document.getElementById("binSpecifics' . ($i5+1) . ($i+1) . '").style.display = "none";' . "\n";
				$fileString .= 'document.getElementById("threshold' . ($i5+1) . ($i+1) . '").style.display = "block";' . "\n";
				$fileString .= 'console.log("' . ($i5+1) . ($i+1) . '");' . "\n";
			$fileString .= '} else if (analysis == "Min-Max"){' . "\n";
				$fileString .= 'document.getElementById("binInformation' . ($i5+1) . ($i+1) . '").style.display = "block";' . "\n";
				$fileString .= 'document.getElementById("binSpecifics' . ($i5+1) . ($i+1) . '").style.display = "block";' . "\n";
				$fileString .= 'document.getElementById("threshold' . ($i5+1) . ($i+1) . '").style.display = "none";' . "\n";
			$fileString .= '} else if (analysis == "kWh"){' . "\n";
				$fileString .= 'document.getElementById("binInformation' . ($i5+1) . ($i+1) . '").style.display = "none";' . "\n";
				$fileString .= 'document.getElementById("binSpecifics' . ($i5+1) . ($i+1) . '").style.display = "none";' . "\n";
				$fileString .= 'document.getElementById("threshold' . ($i5+1) . ($i+1) . '").style.display = "none";' . "\n";
			$fileString .= '} else if (analysis == "Range Analysis"){' . "\n";
				$fileString .= 'document.getElementById("binInformation' . ($i5+1) . ($i+1) . '").style.display = "block";' . "\n";
				$fileString .= 'document.getElementById("binSpecifics' . ($i5+1) . ($i+1) . '").style.display = "block";' . "\n";
				$fileString .= 'document.getElementById("threshold' . ($i5+1) . ($i+1) . '").style.display = "block";' . "\n";
			$fileString .= '}' . "\n";
		$fileString .= '} );' . "\n" . "\n";
		fwrite($javaFile, $fileString);
	}
}

for ($i = 0; $i < $NUM_SENSORS; $i++){
	for ($i5 = 0; $i5 < 3; $i5++){
		fwrite($javaFile, '$("#binChoice');
		$fileString = $i5+1 . $i+1 . '").change(function() {' . "\n";
		$fileString .= 'var bins = ';
		fwrite($javaFile, $fileString);
		fwrite($javaFile, '$("#binChoice');
			$fileString =  $i5+1 . $i+1 . '").val();' . "\n";
			$fileString .= 'console.log(bins);' . "\n";
			$fileString .= 'if (bins == "From Sensor"){' . "\n";
				$fileString .= 'document.getElementById("customTimeBlock' . ($i5+1) . ($i+1) . '").style.display = "none";' . "\n";
				$fileString .= 'document.getElementById("fromSensorBlock' . ($i5+1) . ($i+1) . '").style.display = "block";' . "\n";
				$fileString .= 'document.getElementById("summaryMethod' . ($i5+1) . ($i+1) . '").style.display = "block";' . "\n";
			$fileString .= '} else if (bins == "Custom Time"){' . "\n";
				$fileString .= 'document.getElementById("customTimeBlock' . ($i5+1) . ($i+1) . '").style.display = "block";' . "\n";
				$fileString .= 'document.getElementById("fromSensorBlock' . ($i5+1) . ($i+1) . '").style.display = "none";' . "\n";
				$fileString .= 'document.getElementById("summaryMethod' . ($i5+1) . ($i+1) . '").style.display = "block";' . "\n";
			$fileString .= '} else {' . "\n";
				$fileString .= 'document.getElementById("customTimeBlock' . ($i5+1) . ($i+1) . '").style.display = "none";' . "\n";
				$fileString .= 'document.getElementById("fromSensorBlock' . ($i5+1) . ($i+1) . '").style.display = "none";' . "\n";
				$fileString .= 'document.getElementById("summaryMethod' . ($i5+1) . ($i+1) . '").style.display = "none";' . "\n";
			$fileString .= '}' . "\n";
		$fileString .= '} );' . "\n" . "\n";
		fwrite($javaFile, $fileString);
	}
}

?>