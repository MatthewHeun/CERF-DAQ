<!DOCTYPE html>
<html lang="en">

<head>

<?php if(isset($_GET['sensorNumber'])){
		$sensor_number = $_GET['sensorNumber'];
	} ?>
<?php include 'Sensors/globalSensorInfo.php'; ?>
<?php include 'Elements/header.php'; ?>
<?php include 'Elements/includes.php'; ?>
<?php
	$pageSensor = $SENSOR_INFO[$sensor_number-1]->name;
	$pageLink = 'sensor.php?sensorNumber=' . $sensor_number;
?>
<script>

setTimeout(function(){
	window.location.reload(1);
}, 60000);

</script>

</head>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'Elements/navigation.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12" style="margin-top:50px;">
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
                 	for ($k = 0; $k < $SENSOR_INFO[$sensor_number-1]->numberOfAnalysis; $k ++){
	                 	if ($SENSOR_INFO[$sensor_number-1]->analysis[$k] == "On-Peak Off-Peak %") {
							include 'Elements/barchartpeak.php'; 
						} else {
							include 'Elements/barchart.php';
						}
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
			for ($k = 0; $k < $SENSOR_INFO[$sensor_number-1]->numberOfAnalysis; $k ++){
	            if ($SENSOR_INFO[$sensor_number-1]->analysis[$k] == "On-Peak Off-Peak %") {
					include 'Elements/morisbar.php'; 
				}
			}
		?>
		<?php 

			include 'Elements/morisline.php';
	
		?>
	</script>

</body>

</html>
