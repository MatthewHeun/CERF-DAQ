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
                    <ul class="nav" id="side-menu" style="overflow:hidden; overflow-y:scroll; height:90vh;">
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
				<li>
                   			<a href="admin.php"><i class="fa fa-user fa-fw"></i> Admin</a>
                   		</li>

                   		<?php 
                   			
                   			if (strpos($pageLink, 'sor') !== false){
                   				echo '<li><a> </a></li>';
                   				echo '<li><a style="color:black">Sensor Characteristics: </a></li>';
                   				echo '<ul style="list-style:none; padding-left:10px">';
                   				echo '<li><a style="color:black; Text-decoration:none;" > <span class="fa-stack fa-fw"><i class="fa fa-plug fa-stack-1x"></i></span> i2c port: </a> <a class="pull-right" style="color:black; Text-decoration:none; vertical-align:middle; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->i2cAddress . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                   				echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-slack fa-stack-1x"></i></span> pin number: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->pinNumber . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                          echo '</ul>';
                          echo '<li>';
                          echo '<div class="btn-group-sm" role="group" style="margin:auto; padding:2%;">';
                          for ($k=0; $k<$SENSOR_INFO[$sensor_number-1]->numberOfAnalysis; $k++){
                             echo '<button onClick="analysisSelection' . ($k+1) . '()" type="button" class="btn btn-primary">Analysis' . ($k+1) . '</button>';
                          }
                          echo '</div>';
                          echo '</li>';
                          echo '<ul style="list-style:none; padding-left:10px">';

                          for ($k=0; $k<$SENSOR_INFO[$sensor_number-1]->numberOfAnalysis; $k++) {
                            echo '<div id="analysisDisplay' . ($k+1);
                            if ($k==0){
                              echo '" style="display:block">' . "\n";
                            } else {
                              echo '" style="display:none">' . "\n";
                            }
                            if ($SENSOR_INFO[$sensor_number-1]->analysis[$k] == "On-Peak Off-Peak %") {
                               echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-search fa-stack-1x"></i></span> analysis type: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">Peak %\'s' . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                            } 
                            elseif ($SENSOR_INFO[$sensor_number-1]->analysis[$k] == "Range Analysis") {
                              echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-search fa-stack-1x"></i></span> analysis type: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">Range' . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                              echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-archive fa-stack-1x"></i></span> bin type: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->binType[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                            }
                            elseif ($SENSOR_INFO[$sensor_number-1]->analysis[$k] == "Min-Max") {
                              echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-search fa-stack-1x"></i></span> analysis type: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">Min-Max' . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                              echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-archive fa-stack-1x"></i></span> bin type: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->binType[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                            }
                              echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-minus-square fa-ffa-stack-1x"></i></span>min: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->thresholdMin[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                                echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-plus-square fa-stack-1x"></i></span>max: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->thresholdMax[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                            if ($SENSOR_INFO[$sensor_number-1]->analysis[$k] != "On-Peak Off-Peak %") {
                              if ($SENSOR_INFO[$sensor_number-1]->binType[$k] == "From Sensor") {
                                echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-sort-numeric-asc fa-stack-1x"></i></span> from sensor number: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->fromSensorNumber[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                                echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-minus-square-o fa-ffa-stack-1x"></i></span> from sensor min: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->fromSensorMin[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                                echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-plus-square-o fa-stack-1x"></i></span> from sensor max: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->fromSensorMax[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                              }
                              if ($SENSOR_INFO[$sensor_number-1]->binType[$k] == "Custom Time") {
                                echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-play fa-stack-1x" style="font-size:1.5em;"></i><i class="fa fa-clock-o fa-inverse fa-stack-1x" style="font-size:1em;"></i></span> start hour: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->customStart[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                                echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-stop fa-stack-1x" style="font-size:1.5em;"></i><i class="fa fa-clock-o fa-inverse fa-stack-1x" style="font-size:1em;"></i></span> stop hour: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->customStop[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                              }
                            }
                            echo '</div>';
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