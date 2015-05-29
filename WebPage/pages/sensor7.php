<!DOCTYPE html>
<html lang="en">

<head>
<?php  $sensor_number = '7'; ?>  <! change this >
<?php include 'Elements/header.php'; ?>
<?php include 'Elements/includes.php'; ?>
<?php
	$pageSensor = $SENSOR7;    // change this
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
                    <?php include 'Elements/barchart.php'; ?>
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
		<?php include 'Elements/morisbar.php'; ?>
		<?php include 'Elements/morisline.php'; ?>
	</script>

</body>

</html>
