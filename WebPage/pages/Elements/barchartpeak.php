<div class="panel panel-default">
                        <div class="panel-heading">
				<?php include 'Elements/barHeader.php' ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
				<div class="col-lg-12">

			<?php
				$Picture = "";
				if ($SENSOR_INFO[$sensor_number-1]->type == "Light"){
					$Picture = '<i class="fa fa-lightbulb-o fa-fw"></i>';
				} elseif ($SENSOR_INFO[$sensor_number-1]->type == "Temperature"){
					$Picture = '<i class="fa fa-tasks fa-fw"></i>';
				} elseif ($SENSOR_INFO[$sensor_number-1]->type == "Occupancy"){
					$Picture = '<i class="fa fa-child fa-fw"></i>';
				} elseif ($SENSOR_INFO[$sensor_number-1]->type == "Current"){
					$Picture = '<i class="fa fa-bolt fa-fw"></i>';
				}
			?>
					<h2 style="text-align:center; margin-top:0px; margin-bottom:15px; background-color:transparent; border-radius:4px; border-color:#337ab7; color:#2e6da4"> Analysis: <?php echo $SENSOR_INFO[$sensor_number-1]->analysis[$k]; echo $Picture?> </h1>
				</div> <!-- col-lg-12 -->
			    </div> <!-- row -->
			    <div class="row">
				<div class="col-lg-4">
                                    <div class="table-responsive" style="height:100%; margin:auto;">
                                        <?php
						$lines = file($Summary_Base . $summary_file . 'a' . ($k+1) . '.csv');
						$table = '<table class="table table-bordered table-hover table-striped"><thead><tr><th>Month</th><th>High Peak %</th><th>Mid Peak %</th><th>Low Peak %</th><th>Off Peak %</th></tr></thead><tbody>';
						$IndexToMonth = array("01" => "Jan", "02" => "Feb", "03" => "Mar", "04" => "Apr", "05" => "May", "06" => "Jun", "07" => "Jul", "08" => "Aug", "09" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");
						foreach($lines as $line){
							if(substr($line, 0, 1) == "#"){
							}else{
								list($pi_id, $sensor_id, $sensor_name, $summary_year, $month, $high, $mid, $low, $off) = explode(',', $line);
								$month = $IndexToMonth[$month];
								if($high == "0.00"){$high = "-";}
								if($mid == "0.00"){$mid = "-";}
								if($low == "0.00"){$low = "-";}
								if($off == "0.00\n"){$off = "-";}
                                if ($summary_year == $year_sum){
                                    $table .= "<tr><td>$month</td><td>$high</td><td>$mid</td><td>$low</td><td>$off</td></tr>";
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
                    </div>
