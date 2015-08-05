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
						<button style="margin-left:0%;" type="sbumit" form="numSensors" class="btn btn-primary" name="submitSensors">Submit</button>
					</span>
				</div> <!-- input-group -->
			</div> <!-- col-lg-3 -->
		</div> <!-- panel-body -->
	</div> <!-- panel panel-default -->


	<div class="panel panel-default">
		<div class="panel-heading"> On-Peak Off-Peak % Analysis Settings </div>
		<div class="panel-body">
			<form action="<?php echo $pageLink?>" id="peakHours" method="get">
			<div class="col-lg-6">
			<div class="row">
			<div class="col-lg-6">
				<p style="font-weight:bold;"> Start Time </p>
				<select class="form-control" name="peakStart">
					<?php
						$options = "";
						$i = 0;
						while ($i < 24) {
							if ($i == $PEAK_START) {
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
			</div> <!-- col-lg-6 -->
			<div class="col-lg-6">
				<p style="font-weight:bold;"> Stop Time </p>
				<select class="form-control" name="peakStop">
					<?php
						$options = "";
						$i = 0;
						while ($i < 24) {
							if ($i == $PEAK_STOP) {
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
			</div> <!-- col-lg-6 -->
			</div> <!-- row -->
				<p> &nbsp; </p>
				<button style="margin-left:0%;" type="sbumit" form="peakHours" class="btn btn-primary btn-block">Submit</button>
			</div> <!-- col-lg-6 -->
			
			<div class="col-lg-2">
				<p style="font-weight:bold;"> Days: </p>
				<div class="container">	
				<?php 
					if ($PEAK_WEEKDAY[0] == "0"){
						echo '<input type="checkbox" name="M" value="0" checked="checked"> M <br>';
					} else {
						echo '<input type="checkbox" name="M" value="0"> M <br>';
					}
					if ($PEAK_WEEKDAY[1] == "1"){
						echo '<input type="checkbox" name="Tu" value="1" checked="checked"> Tu <br>';
					} else {
						echo '<input type="checkbox" name="Tu" value="1"> Tu <br>';
					}
					if ($PEAK_WEEKDAY[2] == "2"){
						echo '<input type="checkbox" name="W" value="2" checked="checked"> W <br>';
					} else {
						echo '<input type="checkbox" name="W" value="2"> W <br>';
					}
					if ($PEAK_WEEKDAY[3] == "3"){
						echo '<input type="checkbox" name="Th" value="3" checked="checked"> Th <br>';
					} else {
						echo '<input type="checkbox" name="Th" value="3"> Th <br>';
					}
					if ($PEAK_WEEKDAY[4] == "4"){
						echo '<input type="checkbox" name="F" value="4" checked="checked"> F <br>';
					} else {
						echo '<input type="checkbox" name="F" value="4"> F <br>';
					}
					if ($PEAK_WEEKDAY[5] == "5"){
						echo '<input type="checkbox" name="Sa" value="5" checked="checked"> Sa <br>';
					} else {
						echo '<input type="checkbox" name="Sa" value="5"> Sa <br>';
					}
					if ($PEAK_WEEKDAY[6] == "6"){
						echo '<input type="checkbox" name="Su" value="6" checked="checked"> Su <br>';
					} else {
						echo '<input type="checkbox" name="Su" value="6"> Su <br>';
					}
					echo '<br>';
				?>
				</div> <!-- container -->
			</div> <!-- col-lg-2 -->
			</form>
			
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
	