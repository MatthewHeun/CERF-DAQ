<?php
$lines = file('2015.txt');
$data = '[';
foreach($lines as $line){
	list($month, $on_peak, $off_peak) = explode(',', $line);
	$data .= "{y:'$month',a: $on_peak,b: $off_peak},";
}
$data = rtrim($data, ',');
$data .= '],';
echo $data;
?>

