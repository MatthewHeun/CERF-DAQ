<?php
$lines = file('2015.txt');
$table = '<table class="table table-bordered table-hover table-striped"><thead><tr><th>Month</th><th>On Peak %</th><th>Off Peak %</th></tr></thead><tbody>';
foreach($lines as $line){
	list($month, $on_peak, $off_peak) = explode(',', $line);
	$table .= "<tr><td>$month</td><td>$on_peak</td><td>$off_peak</td></tr>";
}
$table .= '</tbody></table>';
echo $table;

?>

