<!DOCTYPE html>
<html lang="en">

<head>
<?php  $sensor_number = '6'; ?>  <! change this >
<?php include 'Elements/header.php'; ?>
<?php include 'Elements/includes.php'; ?>
<?php
	$pageSensor = $SENSOR_NAMES[$sensor_number-1];
	$pageLink = 'sensor' . $sensor_number . '.php';
	
?>

</head>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'Elements/navigation.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $pageSensor ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <?php include 'Elements/linechart.php'; ?>
                    <!-- /.YEAR SENSOR 3 panel -->
                    <?php 
			if ($ANALYSIS_TYPES[$sensor_number-1] == "on/off-peak") {
				include 'Elements/barchartpeak.php'; 
			} elseif ($ANALYSIS_TYPES[$sensor_number-1] == "min-max-ave") {
				include 'Elements/barchartmin-max-ave.php';
			} elseif ($ANALYSIS_TYPES[$sensor_number-1] == "bins") {
				include 'Elements/barchartbins.php';
			}
		    ?>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include 'Elements/scriptincludes.php'; ?>
	<script>
		<?php 
			if ($ANALYSIS_TYPES[$sensor_number-1] == "on/off-peak") {
				include 'Elements/morisbar.php'; 
			} elseif ($ANALYSIS_TYPES[$sensor_number-1] == "min-max-ave") {
				include 'Elements/morisdonuttempday.php';
				include 'Elements/morisdonuttempnight.php';
			}
		?>
		<?php 
			if ($SENSOR_TYPES[$sensor_number-1] == "Light") {
				include 'Elements/morisline.php';
			} elseif ($SENSOR_TYPES[$sensor_number-1] == "Temperature") {
				include 'Elements/morislinetemp.php';
			} elseif ($SENSOR_TYPES[$sensor_number-1] == "Occupancy") {
				include 'Elements/morislineocc.php';
			}
		?>
	</script>

</body>

</html>
