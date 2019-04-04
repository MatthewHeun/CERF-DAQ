<?php 
	session_start();
	if (!(isset($_SESSION['userHASH']))) {
		header("Location: ../pages/index.php?error=adminrequired");
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<?php $pageLink = 'configuration.php'; ?>
<?php include 'Elements/header.php'; ?>
<?php include 'Elements/includes.php'; ?>
<?php include 'Sensors/getNumSensors.php'; ?>
<?php include 'Sensors/getSensorInfo.php'; ?>
<?php include 'Sensors/getOnPeakOffPeakTime.php'; ?>
<?php include 'Configuration_Page/createJavascript.php'; ?>
<script language="JavaScript">

function loadAndAlert(){
	alert('After the page refreshes, hit "Display Updates!" to make the changes visible');
}

var NUM_SENSORS = <?php Print($NUM_SENSORS); ?>;
</script>
</head>

<body>
	<div id = "wrapper">
		<!--Navigation -->
		<?php include 'Elements/navigation.php'; ?>
	
	<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12" style="margin-top:50px">
                    <h1 class="page-header">Configuration</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
	
	<div class="panel panel-default">
		<div class="panel-heading"> Sensor Configuration </div>
		<div class="panel-body">
			<div class="col-lg-3">
				<p style="font-weight:bold;"> Number of Sensors </p>
				<div class="input-group">
					<div class="form-group">
						<form action="<?php echo $pageLink?>" id="numSensors" method="get">
							<select class="form-control" name="numSensors">
								<?php
									$options = "";
									$i = 1;
									while ($i < 33) {
										if ($i == $NUM_SENSORS) {
											$options .= ('<option selected="selected">' . $i . "</option>" . "\n");
										} 
										else { 
											$options .= ("<option>" . $i . "</option>" . "\n");
										}
										$i += 1;
									}
									echo $options;
								?>
							</select>
						</form>
					</div> <!-- form-group -->
					<span class="input-group-btn">
						<button style="margin-left:0%;" type="submit" form="numSensors" class="btn btn-primary" name="submitSensors">Submit</button>
					</span>
				</div> <!-- input-group -->
			</div> <!-- col-lg-3 -->
		</div> <!-- panel-body -->
	</div> <!-- panel panel-default -->
	<button type="button" onclick="window.location.href=window.location.href" class="btn btn-primary btn-block">Display Updates!</button>
	<br>
	<button onclick="loadAndAlert()" style="margin-left:auto; margin-right:auto;" type="submit" form="sensorSpecifics" class="btn btn-primary btn-block" name="sensorInfo">Submit</button>
	<br>
		<?php include 'Configuration_Page/sensorConfig.php'; ?>
 	<br><br>
	</div>  <!-- page-wrapper -->
	</div>	<!-- wrapper -->
		<?php include 'Elements/scriptincludes.php'; ?>
</body>
	