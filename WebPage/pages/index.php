<!DOCTYPE html>
<html lang="en">

<head>

<?php include 'Elements/header.php'; ?>
<?php include 'Elements/includes.php'; ?>
<?php
	$pageLink = 'index.php';
	$sensor_number = 1;
	$pageSensor = "Bruce";

?>

</head>

<body>
<?php

	$size = 0;
	foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($Raw_Base)) as $file){
		$size+=$file->getSize();
	}
	$size /= 1000000;
	$size = number_format($size, 1, '.', ',');
	$free_space = disk_free_space ('/')/1000000000;
	$free_space = number_format($free_space, 1, '.', ',');
?>
    <div id="wrapper">

               <!-- Navigation -->
        <?php include 'Elements/navigation.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <?php include 'Elements/downloads.php'; ?>
            <div class="row">
                <div class="col-lg-12">
                   <?php include 'Elements/dashboard.php'; ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
	<?php include 'Elements/scriptincludes.php'; ?>
	<script>
		<?php 
			$i = 1;
			$graphnum = 1;
			while ($i <= $NUMBER_OF_SENSORS){
				$year_file = "Pi_" . $Pi_Number . "_" . $i . "_" . $year_sum . ".csv";
				$sensor_number = i;
				$pageSensor = $SENSOR_NAMES[$i - 1];
				include 'Elements/morisbar.php'; 
				$i = $i + 1;
				$graphnum = $graphnum + 1;
			}
		?>
		
	</script>

</body>

</html>
