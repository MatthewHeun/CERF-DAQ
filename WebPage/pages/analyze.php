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
}, 1000);

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
			<p> The analysis typically runs every midnight, in normal circumstances this should be sufficient. However, if you have updated parameters
				like the thresholds or the peak start and stop times, the data displayed may no longer be accurate. To correct for this you may hit the 
				"Analyze" button. Be warned, it may take some time! </p>
			</div> <!-- panel-body -->
	</div> <!-- panel panel-default -->
	<?php 
		echo '<div class="row">';
			echo '<div class="col-lg-4"></div>';
			echo '<div class="col-lg-4">';
				echo '<a><i class="fa fa-refresh fa-5x fa-spin"></i></a>';
			echo '</div>';
			echo '<div class="col-lg-4"></div>';
		echo '</div> <!-- row -->';
		if ($CALL_FUNCTION == true){
			echo "running function";
			echo shell_exec('sh /home/cjk36/Desktop/CERF-DAQ/Python/runAnalysis.sh');
		}
	?>
			<br>
	<form action="analyze.php" method="get" id="runAnalysis">
		<input type="hidden" name="callFunction" value="DO IT!">
	</form>
	<button type="submit" class="btn btn-primary btn-block" form="runAnalysis">Analyze!</button>
	</div>  <!-- page-wrapper -->
	</div>	<!-- wrapper -->
</body>
	