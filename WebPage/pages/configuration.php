<!DOCTYPE html>
<html lang="en">

<head>

<?php $pageLink = 'configuration.php'; ?>
<?php include 'Elements/header.php'; ?>
<?php include 'Elements/includes.php'; ?>
<?php include 'Sensors/getNumSensors.php'; ?>
<?php include 'Sensors/getSensorInfo.php'; ?>

</head>

<body>
	<div id = "wrapper">
		<!--Navigation -->
		<?php include 'Elements/navigation.php'; ?>
	
	<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Configuration</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
	
	<div class="panel panel-default">
		<div class="panel-heading"> Sensor Configuration </div>
		<div class="panel-body">
			<div class="col-lg-3">
			<form action="<?php echo $pageLink?>" id="numSensors" method="get">
				<p> Number of Sensors </p>
				<select class="form-control" name="numLightSensors">
					<?php
						$options = "";
						$i = 1;
						while ($i < 33) {
							$options .= ("<option>" . $i . "</option>" . "\n");
							$i += 1;
						}
						echo $options;
					?>
				</select>
			</form>
			<br>
			<button style="margin-left:5%;" type="sbumit" form="numSensors" class="btn btn-primary" name="submitSensors">Submit</button>
			</div> <!-- col-lg-3 -->
			</div> <!-- panel-body -->
	</div> <!-- panel panel-default -->
		<?php include 'Elements/sensorConfig.php'; ?>
  	<br><br>
	</div>  <!-- page-wrapper -->
	</div>	<!-- wrapper -->
</body>
	