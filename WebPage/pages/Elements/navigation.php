<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0;">
    <div class="navbar-header" style="overflow:hidden">
        <div class="container">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
                <a class="navbar-brand" href="index.php">CERF Pi <?php echo $PI_NUMBER ?></a>
        </div>
    </div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						<li>
                            <a href="index.php"><i class="fa fa-bar-chart-o fa-fw"></i> Dashboard</a>
						</li>
			
						<?php
							$i = 1;
							while ($i <= $NUM_SENSORS){
								$Picture = ".";
								if ($SENSOR_INFO[$i-1]->type == "Light"){
									$Picture = '<i class="fa fa-lightbulb-o fa-fw pull-right"></i>';
								} elseif ($SENSOR_INFO[$i-1]->type == "Temperature"){
									$Picture = '<i class="fa fa-tasks fa-fw pull-right"></i>';
								} elseif ($SENSOR_INFO[$i-1]->type == "Occupancy"){
									$Picture = '<i class="fa fa-child fa-fw pull-right"></i>';
								}
								echo '<li>';
                            	echo '<a href="sensor.php?sensorNumber=' . $i . '"><i class="fa fa-dashboard fa-fw"></i>  ' . $SENSOR_INFO[$i-1]->name . $Picture . '</a>' . "\n";
                        		echo '</li>';
								$i = $i + 1;
							}
						?>

						<li>
			    			<a href="configuration.php" onClick="return confirm('Are you sure you want to edit the Pi\'s configuration settings? Incorrectly setting parameters can destroy data.');"><i class="fa fa-gear fa-fw"></i>Configuration Panel</a>
                   		</li>
                   		<li>
                   			<a href="analyze.php"><i class="fa fa-line-chart fa-fw"></i> Analyze</a>
                   		</li>

                   		<?php 
                   			
                   			if (strpos($pageLink, 'sor') !== false){
                   				echo '<li><a> </a></li>';
                   				echo '<li><a style="color:black">Sensor Characteristics: </a></li>';
                   				echo '<ul style="list-style:none;">';
                   				echo '<li><a style="color:black"> <i class="fa fa-plug fa-fw"></i> i2c port: </a> <a class="pull-right" style="color:black">' . $SENSOR_INFO[$sensor_number-1]->i2cAddress . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                   				echo '<li><a style="color:black"> <i class="fa fa-slack fa-fw"></i> pin number: </a> <a class="pull-right" style="color:black">' . $SENSOR_INFO[$sensor_number-1]->pinNumber . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                          if ($SENSOR_INFO[$sensor_number-1]->analysis == "On-Peak Off-Peak %") {
                   				   echo '<li><a style="color:black"> <i class="fa fa-play fa-fw"></i> Analysis Type: </a> <a class="pull-right" style="color:black">Peak %\'s' . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                             echo '<li><a style="color:black"> <i class="fa fa-play fa-fw"></i> peak start time: </a> <a class="pull-right" style="color:black">' . $SENSOR_INFO[$sensor_number-1]->peakStart . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                   				   echo '<li><a style="color:black"> <i class="fa fa-stop fa-fw"></i> peak end time: </a> <a class="pull-right" style="color:black">' . $SENSOR_INFO[$sensor_number-1]->peakStop . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                          } else {
                            echo '<li><a style="color:black"> <i class="fa fa-play fa-fw"></i> Analysis Type: </a> <a class="pull-right" style="color:black">' . $SENSOR_INFO[$sensor_number-1]->analysis . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                            echo '<li><a style="color:black"> <i class="fa fa-archive fa-fw"></i> Bin Type: </a> <a class="pull-right" style="color:black">' . $SENSOR_INFO[$sensor_number-1]->binType . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                          }
                   				echo '<li><a style="color:black"> <i class="fa fa-minus-square fa-fw"></i> min threshold: </a> <a class="pull-right" style="color:black">' . $SENSOR_INFO[$sensor_number-1]->thresholdMin . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                   				echo '<li><a style="color:black"> <i class="fa fa-plus-square fa-fw"></i> max threshold: </a> <a class="pull-right" style="color:black">' . $SENSOR_INFO[$sensor_number-1]->thresholdMax . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                          if ($SENSOR_INFO[$sensor_number-1]->binType == "From Sensor") {
                            echo '<li><a style="color:black"> <i class="fa fa-play fa-fw"></i> from sensor number: </a> <a class="pull-right" style="color:black">' . $SENSOR_INFO[$sensor_number-1]->fromSensorNumber . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                            echo '<li><a style="color:black"> <i class="fa fa-play fa-fw"></i> from sensor max: </a> <a class="pull-right" style="color:black">' . $SENSOR_INFO[$sensor_number-1]->fromSensorMax . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                            echo '<li><a style="color:black"> <i class="fa fa-play fa-fw"></i> from sensor min: </a> <a class="pull-right" style="color:black">' . $SENSOR_INFO[$sensor_number-1]->fromSensorMin . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                          }
                          if ($SENSOR_INFO[$sensor_number-1]->binType == "Custom Time") {
                            echo '<li><a style="color:black"> <i class="fa fa-play fa-fw"></i> Start Hour: </a> <a class="pull-right" style="color:black">' . $SENSOR_INFO[$sensor_number-1]->customStartHour . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                            echo '<li><a style="color:black"> <i class="fa fa-play fa-fw"></i> Start Hour: </a> <a class="pull-right" style="color:black">' . $SENSOR_INFO[$sensor_number-1]->customStopHour . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                          }
                          echo '</ul>';
                   			}
                   			
                   		?>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>