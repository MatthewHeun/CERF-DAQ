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
<meta http-equiv="refresh" content="5">

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
                    <h1 class="page-header">ANALYZE!</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
	
	<div class="panel panel-default">
		<div class="panel-heading"> Run Analysis... </div>
		<div class="panel-body">
			<p> The analysis typically runs every midnight, in normal circumstances this should be sufficient. However, if you have recently updated parameters
				like the thresholds or the peak start and stop times, the data displayed may no longer be accurate. To correct for this you may hit the 
				"Analyze" button. Be warned, it may take some time! </p>
			</div> <!-- panel-body -->
	</div> <!-- panel panel-default -->
	<?php 
		if ($BUSY == 1){
			echo '<h1 align="center"><span class="label label-warning"><i class="fa fa-refresh fa-spin"></i> Please be Patient <i class="fa fa-refresh fa-spin"></i></span></h1>';
			echo '<br>';
			echo '<div class="progress">';
			echo '<div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="background-color:#5BC0DE; width:' . $PROGRESS . '">';
			echo '<span>' . $PROGRESS . '</span>';
			echo '</div>';
			echo '</div>';
		} else {
			echo '<h1 align="center"><span class="label label-success">The Analysis is not running</span></h1>';
			
		}
		
		if ($CALL_FUNCTION == true){
			echo "starting...";
			shell_exec('sh /home/pi/Desktop/CERF-DAQ/Python/runAnalysis.sh');
		}
	?>
			<br>
	<form action="analyze.php" method="get" id="runAnalysis">
		<input type="hidden" name="callFunction" value="DO IT!">
	</form>
	<button type="submit" class="btn-lg btn-primary btn-block" form="runAnalysis">Analyze!</button>
	</div>  <!-- page-wrapper -->
	</div>	<!-- wrapper -->
</body>
	