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

<?php $pageLink = 'admin.php'; ?>
<?php include 'Elements/header.php'; ?>
<?php include 'Elements/includes.php'; ?>
<?php include 'Sensors/getNumSensors.php'; ?>
<?php include 'Sensors/getSensorInfo.php'; ?>

<script>

setTimeout(function(){
	window.location=window.location.href.split("?")[0];
}, 2000);

</script>

</head>

<body>
	<div id = "wrapper">
		<!--Navigation -->
		<?php include 'Elements/navigation.php'; ?>
	
	<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12" style="margin-top:50px">
                    <h1 class="page-header">ADMINISTRATION</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
	
	<div class="panel panel-default">
		<div class="panel-heading"> Control Functions: </div>
		<div class="panel-body">
			<p> Be careful with these functions! They give you all the power! </p>
	
	<?php 
	
		if ($START_PI == true){
			$startFile = fopen('dataCollectionSet.txt', w);
			fwrite($startFile, '1');
		}
		if ($PAUSE_PI == true){
			$pauseFile = fopen('dataCollectionSet.txt', w);
			fwrite($pauseFile, '0');
		}
		if ($RESET_PI == true){
			$resetFile = fopen('reset.txt', w);
			fwrite($resetFile, '1');
		}
		if ($ZIP_PI == true){
			$zipFile = fopen('zipStatus.txt' , w);
			fwrite($zipFile, '1');
			exec('sh /home/pi/Desktop/CERF-DAQ/Scripts/zip-data.sh');
		}
	?>


	<div class="row">
	<div class="col-lg-6">
	
	<form action="admin.php" method="get" id="start-pi">
		<input type="hidden" name="start-pi" value="DO IT!">
	</form>
	<button type="submit" class="btn-lg btn-success btn-block" form="start-pi">Start Data Collection <?php if ($START_PI == true) {echo '<i class="fa fa-refresh fa-spin"></i>';} ?></button>
	
	<form action="admin.php" method="get" id="pause-pi">
		<input type="hidden" name="pause-pi" value="DO IT!">
	</form>
	<button type="submit" class="btn-lg btn-warning btn-block" form="pause-pi">Pause Data Collection <?php if ($PAUSE_PI == true) {echo '<i class="fa fa-refresh fa-spin"></i>';} ?></button>
	

	</div> <!-- col-lg-6 -->
	<div class="col-lg-6">

	<h2>Data Collection: <?php if ($DATA_COLLECTION_SET == '1'){echo '<i class="fa fa-play" style="color:#5cb85c;"></i> SET TO RUN';} else {echo '<i class="fa fa-pause" style="color:#F0AD4E;"></i> SET TO PAUSE';} ?></h2>
	</div> <!-- col-lg-6 -->

	</div> <!-- row -->
	<br>
	<div class="row">
	<div class="col-lg-6">


	<form action="admin.php" method="get" id="reset-pi">
		<input type="hidden" name="reset-pi" value="DO IT!">
	</form>
	<button onClick="return confirm('Are you sure you want to delete ALL of the data on the Pi?!?!');" type="submit" class="btn-lg btn-danger btn-block" form="reset-pi">Reset Data <?php if ($RESET_PI == true) {echo '<i class="fa fa-refresh fa-spin"></i>';} ?></button>
	
	<form action="admin.php" method="get" id="zip-pi">
		<input type="hidden" name="zip-pi" value="DO IT!">
	</form>
	<button type="submit" class="btn-lg btn-info btn-block" form="zip-pi">Zip Data <?php if ($ZIP_PI == true) {echo '<i class="fa fa-refresh fa-spin"></i>';} ?></button>

	</div> <!-- col-lg-6 -->
	</div> <!-- row -->
	</div> <!-- panel-body -->
	</div> <!-- panel panel-default -->


	<div class="panel panel-default">
		<div class="panel-heading"> Pi Health Status: </div>
		<div class="panel-body">

			<p>Cron Health: <?php if ($RUNNING == 1){echo '<i class="fa fa-check" style="color:#5cb85c;"></i> OK';} else {echo '<i class="fa fa-exclamation-triangle" style="color:#D9534F;"></i> NOT RUNNING';}?><p>
			<p>Data Collection Confirmation: <?php if ($DATA_COLLECTION_STATUS == 1){echo '<i class="fa fa-check" style="color:#5cb85c;"></i> OK';} else {echo '<i class="fa fa-exclamation-triangle" style="color:#D9534F;"></i> NOT RUNNING';}?><p>
			<p>Zip Health: <?php if ($ZIP_HEALTH == 1){echo '<i class="fa fa-check" style="color:#5cb85c;"></i> OK';} else {echo '<i class="fa fa-exclamation-triangle" style="color:#D9534F;"></i> NOT RUNNING';}?><p>
			<p>Update Health: <?php if ($UPDATE_HEALTH == 1){echo '<i class="fa fa-check" style="color:#5cb85c;"></i> OK';} else {echo '<i class="fa fa-exclamation-triangle" style="color:#D9534F;"></i> ERROR';}?><p>

	</div> <!-- panel-body -->
	</div> <!-- panel panel-default -->
	<br>
	<br>
	</div> <!-- page-wrapper -->
	</div> <!-- wrapper -->
</body>
	