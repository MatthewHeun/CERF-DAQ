<?php

$javaFile = fopen("/home/cjk36/Desktop/CERF-DAQ/WebPage/js/navigation_javascript.js", "w");

for ($i5 = 0; $i5 < 3; $i5++){
	fwrite($javaFile, 'function analysisSelection' . ($i5+1) . '() {' .  "\n");
		$fileString = 'console.log(' . ($i5+1) . ');' . "\n";
		$fileString .= 'if (' . ($i5+1) . ' == "1"){' . "\n";
			$fileString .= 'document.getElementById("analysisDisplay1").style.display = "block";' . "\n";
			$fileString .= 'document.getElementById("analysisDisplay2").style.display = "none";' . "\n";
			$fileString .= 'document.getElementById("analysisDisplay3").style.display = "none";' . "\n";
		$fileString .= '} else if (' . ($i5+1) . ' == "2"){' . "\n";
			$fileString .= 'document.getElementById("analysisDisplay1").style.display = "none";' . "\n";
			$fileString .= 'document.getElementById("analysisDisplay2").style.display = "block";' . "\n";
			$fileString .= 'document.getElementById("analysisDisplay3").style.display = "none";' . "\n";
		$fileString .= '} else {' . "\n";
			$fileString .= 'document.getElementById("analysisDisplay1").style.display = "none";' . "\n";
			$fileString .= 'document.getElementById("analysisDisplay2").style.display = "none";' . "\n";
			$fileString .= 'document.getElementById("analysisDisplay3").style.display = "block";' . "\n";
		$fileString .= '}' . "\n";
	$fileString .= '};' . "\n" . "\n";
	fwrite($javaFile, $fileString);
}

?>