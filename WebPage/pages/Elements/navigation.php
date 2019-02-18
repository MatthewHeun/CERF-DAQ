<style type="text/css">
	.container.custom-px-2 {
		padding-left: ($spacer * .5) !important;
		padding-right: ($spacer * .5) !important;
	}
</style>

<?php 
	session_start();
?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0;">
	<div>
		<div class="navbar-header" style="overflow:hidden">
			<a class="navbar-brand" href="index.php">CERF Pi <?php echo $PI_NUMBER ?></a>
		</div>
		<?php
			if (isset($_SESSION['userHASH'])) {
				$loginform = '<form class="navbar-form navbar-right" action="/pages/Elements/logout.inc.php" method="post">'
						   . '<button type="submit" class="btn btn-default" name="logout-submit">Logout</button>'
						   . '</form>';
			} else {
				$loginform = '<form class="navbar-form navbar-right" action="/pages/Elements/login.inc.php" method="post">'
						   . '<input type="text" class="form-control" name="mailuid" placeholder="Username/Email...">'
						   . '<input type="password" class="form-control" name="pwd" placeholder="Password...">'
						   . '<button type="submit" class="btn btn-default" name="login-submit">Login</button>'
						   . '</form>';
			}
			echo $loginform;
		?>
	</div>
	<!-- /.navbar-header -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu" style="overflow:auto">
					<li>
                        <a href="index.php"><i class="fa fa-bar-chart-o fa-fw"></i>Dashboard</a>
					</li>
					<?php
						$i = 1;
						while ($i <= $NUM_SENSORS){
							$Picture = "";
							if ($SENSOR_INFO[$i-1]->type == "Light"){
								$Picture = '<i class="fa fa-lightbulb-o fa-fw pull-right"></i>';
							} elseif ($SENSOR_INFO[$i-1]->type == "Temperature"){
								$Picture = '<i class="fa fa-tasks fa-fw pull-right"></i>';
							} elseif ($SENSOR_INFO[$i-1]->type == "Occupancy"){
								$Picture = '<i class="fa fa-child fa-fw pull-right"></i>';
							} elseif ($SENSOR_INFO[$i-1]->type == "Current"){
								$Picture = '<i class="fa fa-bolt fa-fw pull-right"></i>';
							}
							echo '<li>';
                           	echo '<a href="sensor.php?sensorNumber=' . $i . '"><i class="fa fa-dashboard fa-fw"></i>  ' . $i . ' ' . $SENSOR_INFO[$i-1]->name . $Picture . '</a>' . "\n";
                       		echo '</li>';
							$i = $i + 1;
						}

						if (isset($_SESSION['userHASH'])) {
							echo '<li>'
							   . '<a href="configuration.php" onClick="return confirm('
							   . 'Are you sure you want to edit the Pi\'s configuration settings? Incorrectly setting parameters can destroy data.'
							   . ');"><i class="fa fa-gear fa-fw"></i>Configuration Panel</a>'
							   . '</li>'
							   . '<li>'
							   . '<a href="analyze.php"><i class="fa fa-line-chart fa-fw"></i> Analyze</a>'
							   . '</li>'
							   . '<li>'
							   . '<a href="admin.php"><i class="fa fa-user fa-fw"></i> Admin</a>'
							   . '</li>';
						}
					
               			if (strpos($pageLink, 'sor') !== false){
                   			echo '<li><a> </a></li>';
                   			echo '<li><a style="color:black">Sensor Characteristics: </a></li>';
                   			echo '<ul style="list-style:none; padding-left:10px">';
                   			echo '<li><a style="color:black; Text-decoration:none;" > <span class="fa-stack fa-fw"><i class="fa fa-plug fa-stack-1x"></i></span> i2c port: </a> <a class="pull-right" style="color:black; Text-decoration:none; vertical-align:middle; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->i2cAddress . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                   			echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-slack fa-stack-1x"></i></span> pin number: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->pinNumber . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
                            echo '</ul>';
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
									echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-minus-square fa-ffa-stack-1x"></i></span>min: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->thresholdMin[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
									echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-plus-square fa-stack-1x"></i></span>max: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->thresholdMax[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
								} 
								elseif ($SENSOR_INFO[$sensor_number-1]->analysis[$k] == "Range Analysis") {
									echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-search fa-stack-1x"></i></span> analysis type: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">Range' . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
									echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-archive fa-stack-1x"></i></span> bin type: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->binType[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
									echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-minus-square fa-ffa-stack-1x"></i></span>min: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->thresholdMin[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
									echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-plus-square fa-stack-1x"></i></span>max: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->thresholdMax[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
								}
								elseif ($SENSOR_INFO[$sensor_number-1]->analysis[$k] == "Min-Max") {
									echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-search fa-stack-1x"></i></span> analysis type: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">Min-Max' . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
									echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-archive fa-stack-1x"></i></span> bin type: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->binType[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
								}
			
								$checkmarks = new ArrayObject(array());
								$intConversion = new ArrayObject(array());
								for ($d=0; $d<7; $d++){
									if ($SENSOR_INFO[$sensor_number-1]->weekdays[$k][$d] != ""){
										$intConversion->append($d);
									} else {
										$intConversion->append(10);
									}
									if ($intConversion[$d] == $d){
										$checkmarks->append('<span class="fa-stack fa-fw"><i class="fa fa-check fa-stack-1x"></i></span>');
									} else {
										$checkmarks->append("");
									}
								}


		                              
								if ($SENSOR_INFO[$sensor_number-1]->analysis[$k] != "On-Peak Off-Peak %") {
									if ($SENSOR_INFO[$sensor_number-1]->binType[$k] == "From Sensor") {
										echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-sort-numeric-asc fa-stack-1x"></i></span> from sensor number: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->fromSensorNumber[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
										echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-minus-square-o fa-ffa-stack-1x"></i></span> from sensor min: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->fromSensorMin[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
										echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-plus-square-o fa-stack-1x"></i></span> from sensor max: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->fromSensorMax[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
									}

									if ($SENSOR_INFO[$sensor_number-1]->binType[$k] == "Custom Time") {
										echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-play fa-stack-1x" style="font-size:1.5em;"></i><i class="fa fa-clock-o fa-inverse fa-stack-1x" style="font-size:1em;"></i></span> start hour: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->customStart[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
										echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-stop fa-stack-1x" style="font-size:1.5em;"></i><i class="fa fa-clock-o fa-inverse fa-stack-1x" style="font-size:1em;"></i></span> stop hour: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $SENSOR_INFO[$sensor_number-1]->customStop[$k] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
										echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-calendar-o fa-stack-1x"></i></span> sunday: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $checkmarks[0] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
										echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-calendar-o fa-stack-1x"></i></span> monday: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $checkmarks[1] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
										echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-calendar-o fa-stack-1x"></i></span> tuesday: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $checkmarks[2] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
										echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-calendar-o fa-stack-1x"></i></span> wednesday: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $checkmarks[3] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
										echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-calendar-o fa-stack-1x"></i></span> thursday: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $checkmarks[4] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
										echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-calendar-o fa-stack-1x"></i></span> friday: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $checkmarks[5] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
										echo '<li><a style="color:black; Text-decoration:none;"> <span class="fa-stack fa-fw"><i class="fa fa-calendar-o fa-stack-1x"></i></span> saturday: </a> <a class="pull-right" style="color:black; Text-decoration:none; line-height:2em;">' . $checkmarks[6] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . '</a></li>';
									}
								}
								echo '</div>';
							}
							echo '</ul>';
                   		}

						echo '<li>';
						echo '<div id="buttons">';
                        echo '<div class="btn-group-sm" role="group" style="margin:auto; width:97%;">';
						for ($k=0; $k<$SENSOR_INFO[$sensor_number-1]->numberOfAnalysis; $k++){
							echo '<button onClick="analysisSelection' . ($k+1) . '()" type="button" class="btn btn-primary" style="width:33%;">Analysis' . ($k+1) . '</button>';
                        }
						echo '</div>';
						echo '</div>';
                        echo '</li>';
               		?>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>