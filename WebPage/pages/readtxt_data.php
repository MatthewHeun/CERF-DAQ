<?php
$lines = file('test.txt');
$data = '[';
foreach($lines as $line){
	list($date, $time, $lux) = explode(',', $line);
	$data .= "{time:'$time',lux: $lux},";
}
$data = rtrim($data, ',');
$data .= '],';
echo $data;
?>

