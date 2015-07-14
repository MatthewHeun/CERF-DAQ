<?php

$javaFile = fopen("/home/cjk36/Desktop/CERF-DAQ/WebPage/js/submit_javascript.js", "w");
$fileString = '';

for ($i = 0; $i < 8; $i++){
	fwrite($javaFile, '$("#analysis');
	$fileString = $i+1 . '").change(function() {' . "\n";
	$fileString .= 'var analysis = ';
	fwrite($javaFile, $fileString);
	fwrite($javaFile, '$("#analysis');
		$fileString =  $i+1 . '").val();' . "\n";
		$fileString .= 'if (analysis == "On-Peak Off-Peak %"){' . "\n";
			$fileString .= 'document.getElementById("binInformation' . ($i+1) . '").style.display = "none";' . "\n";
		$fileString .= '} else {' . "\n";
			$fileString .= 'document.getElementById("binInformation' . ($i+1) . '").style.display = "block";' . "\n";
		$fileString .= '}' . "\n";
	$fileString .= '} );' . "\n" . "\n";
	fwrite($javaFile, $fileString);
}

for ($i = 0; $i < 8; $i++){
	fwrite($javaFile, '$("#binChoice');
	$fileString = $i+1 . '").change(function() {' . "\n";
	$fileString .= 'var bins = ';
	fwrite($javaFile, $fileString);
	fwrite($javaFile, '$("#binChoice');
		$fileString =  $i+1 . '").val();' . "\n";
		$fileString .= 'if (bins == "From Sensor"){' . "\n";
			$fileString .= 'document.getElementById("customTimeBlock' . ($i+1) . '").style.display = "none";' . "\n";
			$fileString .= 'document.getElementById("fromSensorBlock' . ($i+1) . '").style.display = "block";' . "\n";
		$fileString .= '} else if (bins == "Custom Time"){' . "\n";
			$fileString .= 'document.getElementById("customTimeBlock' . ($i+1) . '").style.display = "block";' . "\n";
			$fileString .= 'document.getElementById("fromSensorBlock' . ($i+1) . '").style.display = "none";' . "\n";
		$fileString .= '} else {' . "\n";
			$fileString .= 'document.getElementById("customTimeBlock' . ($i+1) . '").style.display = "none";' . "\n";
			$fileString .= 'document.getElementById("fromSensorBlock' . ($i+1) . '").style.display = "none";' . "\n";
		$fileString .= '}' . "\n";
	$fileString .= '} );' . "\n" . "\n";
	fwrite($javaFile, $fileString);
}

?>