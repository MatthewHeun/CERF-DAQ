<div class="panel panel-default">
    <div class="panel-heading">
		<?php include 'Elements/barHeader.php' ?>
    </div> <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
		<h2 style="margin-top:0px; margin-left:5%; margin-bottom:15px; background-color:transparent; border-radius:4px; border-color:#337ab7; color:#2e6da4"> Analysis: <?php echo $SENSOR_INFO[$sensor_number-1]->analysis[$k]; ?> </h1>
                <div class="table-responsive">
                    <?php
						$lines = file($Summary_Base . $summary_file . 'a' . ($k+1) . '.csv');
						if ($SENSOR_INFO[$sensor_number-1]->analysis[$k] == "Range Analysis") {
							$table = '<table class="table table-bordered table-hover table-striped"><thead><tr><th>Start Time</th><th>End Time</th><th>Within Bounds %</th><th>In Time Range</th></tr></thead><tbody>';
						}
						elseif ($SENSOR_INFO[$sensor_number-1]->analysis[$k] == "Min-Max") {
							$table = '<table class="table table-bordered table-hover table-striped"><thead><tr><th>Start Time</th><th>End Time</th><th>Minimum</th><th>Maximum</th><th>Average</th><th>In Time Range</th></tr></thead><tbody>';
						}
						foreach($lines as $line){
							if(substr($line, 0, 1) == "#"){
							} else{
								if ($SENSOR_INFO[$sensor_number-1]->analysis[$k] == "Range Analysis") {
									list($pi_id, $sensor_id, $sensor_name, $start_time, $end_time, $peak_on, $in_time_range) = explode(',', $line);
									$year = explode('-', $start_time);
									if ($year[0] == $year_sum) {
										$table .= "<tr><td>$start_time</td><td>$end_time</td><td>$peak_on</td><td>$in_time_range</td></tr>";
									}
								}
								elseif ($SENSOR_INFO[$sensor_number-1]->analysis[$k] == "Min-Max"){
									list($pi_id, $sensor_id, $sensor_name, $start_time, $end_time, $min, $max, $ave, $in_time_range) = explode(',', $line);
									$year = explode('-', $start_time);
									if ($year[0] == $year_sum) {
										$table .= "<tr><td>$start_time</td><td>$end_time</td><td>$min</td><td>$max</td><td>$ave</td><td>$in_time_range</td></tr>";
									}
								}								
							}
						}
						$table .= '</tbody></table>';
						echo $table;
					?>
                </div> <!-- /.table-responsive -->
            </div> <!-- /.col-lg-12 (nested) -->
        </div>
		<div class="panel-body">
			<div class="row">
    			<div class="col-lg-4 col-lg-offset-2">
                    <div id="donut-day-<?php echo $graphnum ?>" style="height: 100%;"></div> <!-- /.col-lg-4 pull-right -->
		    	</div>
		    	<div class="col-lg-4">
                    <div id="donut-night-<?php echo $graphnum ?>" style="height: 100%;"></div> <!-- /.col-lg-4 (nested) -->
		    	</div> <!-- col-lg-4 -->
			</div> <!-- /.row -->
	    </div> <!-- panel-body -->
    </div> <!-- /.panel-body -->
</div>
