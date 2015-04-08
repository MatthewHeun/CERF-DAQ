<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CERF Pi 1</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>
<?php
	$year = date("Y");
	$day = date("Y-m-d");
	if(isset($_GET['Year'])){
		$year = $_GET['Year'];
	}
	if(isset($_GET['Day'])){
		$day = $_GET['Day'];
	}
	include 'global_vars.php' ;
	
	$day_file1 = "Sensor1/Pi_" . $Pi_Number . "_1_" . $day . ".txt";
	$day_file2 = "Sensor2/Pi_" . $Pi_Number . "_2_" . $day . ".txt";
	$day_file3 = "Sensor3/Pi_" . $Pi_Number . "_3_" . $day . ".txt";
	$year_file1 = "Pi_" . $Pi_Number . "_1_" . $year . ".txt";
	$year_file2 = "Pi_" . $Pi_Number . "_2_" . $year . ".txt";
	$year_file3 = "Pi_" . $Pi_Number . "_3_" . $year . ".txt";
?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Pi <?php echo $Pi_Number ?>: <?php echo $SENSOR3 ?></a>
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						<li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="sensor1.php"><i class="fa fa-dashboard fa-fw"></i> <?php echo $SENSOR1 ?></a>
                        </li>
                        <li>
                            <a href="sensor2.php"><i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $SENSOR2 ?></a>
                        </li>
                        <li>
                            <a href="sensor3.php"><i class="fa fa-table fa-fw"></i> <?php echo $SENSOR3 ?></a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $SENSOR3 ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i><?php echo $SENSOR3 ?> : <?php echo $day ?>
							<div class="pull-right">
							<form action="index.php">
  						<input type="date" name="Day">
  							<input type="submit">
							</form>
							</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="lux-line-chart" style="height: 300px;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.YEAR SENSOR 1 panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $SENSOR3 ?> : <?php echo $year ?>
							<div class="pull-right">
							<form action="sensor1.php" method="get">
							<input type="text" name="Year" placeholder="Enter Year" maxlength= 4>
							<input type="submit">
							</form>
							</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="table-responsive">
                                        <?php
											$lines = file($Summary_Base . $year_file2);
											$table = '<table class="table table-bordered table-hover table-striped"><thead><tr><th>Month</th><th>On Peak %</th><th>Off Peak %</th></tr></thead><tbody>';
											foreach($lines as $line){
												list($month, $on_peak, $off_peak) = explode(',', $line);
												$table .= "<tr><td>$month</td><td>$on_peak</td><td>$off_peak</td></tr>";
											}
											$table .= '</tbody></table>';
											echo $table;
										?>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-8">
                                    <div id="summary-bar-chart" style="height: 100%;"></div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>
	<script>
		new Morris.Bar({
        	element: 'summary-bar-chart',
        	data: <?php
					$filename = $Summary_Base . $year_file1;
					$lines = file($filename);
					$data = '[';
					foreach($lines as $line){
						list($month, $on_peak, $off_peak) = explode(',', $line);
						$data .= "{y:'$month', a: $on_peak, b: $off_peak},";
					}
					$data = rtrim($data, ',');
					$data .= '],';
					echo $data;
				?> 
        	xkey: 'y',
        	ykeys: ['a', 'b'],
        	labels: ['On Peak %', 'Off Peak %'],
        	hideHover: 'auto',
        	resize: true
    	});
		new Morris.Area({
  			// ID of the element in which to draw the chart.
  			element: 'lux-line-chart',
			smooth: false,
			pointSize: 0,
			resize: true,
			goals: [30, 80],
			ymax: 120,
  			// Chart data records -- each entry in this array corresponds to a point on
  			// the chart.
 		 	data: <?php
					$lines = file('../../../Data/Pi_Test_1_Raw_Data/pi_1_1_test.txt');
					$data = '[';
					foreach($lines as $line){
						list($id, $time, $lux) = explode(',', $line);
						$data .= "{minute:'$time',lux: $lux},";
					}
					$data = rtrim($data, ',');
					$data .= '],';
					echo $data;
				?>
  			// The name of the data record attribute that contains x-values.
  			xkey: 'minute',
  			// A list of names of data record attributes that contain y-values.
  			ykeys: ['lux'],
  			// Labels for the ykeys -- will be displayed when you hover over the
  			// chart.
  			labels: ['LUX Value']
		});
	</script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>