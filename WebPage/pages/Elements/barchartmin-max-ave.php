<div class="panel panel-default">
                        <div class="panel-heading">
				<?php include 'Elements/barHeader.php' ?>
                        </div>

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <?php
						$lines = file($Summary_Base . $ANALYSIS_TYPES[$sensor_number-1] . '/' . $year_file);
						$table = '<table class="table table-bordered table-hover table-striped"><thead><tr><th>Month</th><th>Max Temp (day)</th><th>Max Temp (night)</th><th>Min Temp (day)</th><th>MinTemp (night)</th><th>Time in Range (day)</th><th>Timein Range (night)</th></tr></thead><tbody>';
						$IndexToMonth = array("01" => "Jan", "02" => "Feb", "03" => "Mar", "04" => "Apr", "05" => "May", "06" => "Jun", "07" => "Jul", "08" => "Aug", "09" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");
						foreach($lines as $line){
							if(substr($line, 0, 1) == "#"){
							}else{
								list($pi_id, $sensor_id, $sensor_name, $summary_year, $month, $max_day_temp, $max_night_temp, $min_day_temp, $min_night_temp, $time_inRange_day, $time_inRange_night) = explode(',', $line);
								$month = $IndexToMonth[$month];
								if($max_day_temp == "0"){$max_day_temp = "-";}
								if($max_night_temp == "0"){$max_night_temp = "-";}
								if($min_day_temp == "0"){$min_day_temp = "-";}
								if($min_night_temp == "0"){$min_night_temp = "-";}
								if($time_inRange_day == "0.00"){$time_inRange_day = "-";}
								else{($time_inRange_day = $time_inRange_day . '%');}
								if($time_inRange_night == "0.00\n"){$time_inRange_night = "-";}
								else{($time_inRange_night = $time_inRange_night . '%');}
								$table .= "<tr><td>$month</td><td>$max_day_temp</td><td>$max_night_temp</td><td>$min_day_temp</td><td>$min_night_temp</td><td>$time_inRange_day</td><td>$time_inRange_night</td></tr>";
							}
						}
						$table .= '</tbody></table>';
						echo $table;
					?>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-12 (nested) -->
                            </div>
			    <div class="panel-body">
				<div class="row">
				    <div class="col-lg-4 col-lg-offset-2">
                                    	<div id="donut-day-<?php echo $graphnum ?>" style="height: 100%;"></div>
                                	<!-- /.col-lg-4 pull-right -->
				    </div>
				    <div class="col-lg-4">
                                    	<div id="donut-night-<?php echo $graphnum ?>" style="height: 100%;"></div>
                                	<!-- /.col-lg-4 (nested) -->
				    </div>
				</div>
                            	<!-- /.row -->
			    </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
