<div class="panel panel-default">
                        <div class="panel-heading">
				<?php include 'Elements/barHeader.php' ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
				<div class="col-lg-6">
					<h2 style="margin-top:0px; margin-left:5%; margin-bottom:15px; background-color:transparent; border-radius:4px; border-color:#337ab7; color:#2e6da4"> Analysis: <?php echo $SENSOR_INFO[$sensor_number-1]->analysis[$k]; ?> </h1>
				</div> <!-- col-lg-6 -->
			    </div> <!-- row -->
			    <div class="row">
				<div class="col-lg-4">
                                    <div class="table-responsive" style="height:100%; margin:auto;">
                                        <?php
						$lines = file($Summary_Base . $summary_file . 'a' . ($k+1) . '.csv');
						$table = '<table class="table table-bordered table-hover table-striped"><thead><tr><th>Month</th><th>On Peak %</th><th>Off Peak %</th></tr></thead><tbody>';
						$IndexToMonth = array("01" => "Jan", "02" => "Feb", "03" => "Mar", "04" => "Apr", "05" => "May", "06" => "Jun", "07" => "Jul", "08" => "Aug", "09" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");
						foreach($lines as $line){
							if(substr($line, 0, 1) == "#"){
							}else{
								list($pi_id, $sensor_id, $sensor_name, $summary_year, $month, $on, $off) = explode(',', $line);
								$month = $IndexToMonth[$month];
								if($on == "0.00"){$on = "-";}
								if($off == "0.00\n"){$off = "-";}
                                if ($summary_year == $year_sum){
                                    $table .= "<tr><td>$month</td><td>$on</td><td>$off</td></tr>";
                                }
								
							}
						}
						$table .= '</tbody></table>';
						echo $table;
					?>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-8">
                                    <div id="summary-bar-chart-<?php echo $graphnum . '-' . ($k+1) ?>" style="height: 100%;"></div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
			<div class="panel-heading">
			</div>
                    </div>
