<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
        <div class="col-lg-4">
		<a href="<?php echo $pageLink . '&' ?>Day=<?php echo $prev ?>"><h3 style=" margin: 0px; margin-right: 10px; padding: 0px; float: left;"><</h3></a> 
		<a href="<?php echo $pageLink . '&' ?>Day=<?php echo $next ?>"><h3 style=" margin: 0px; margin-right: 10px; padding: 0px; float: left;"> ></h3></a> 
            <p style="font-size:large; padding-top:1%;"> <i class="fa fa-bar-chart-o fa-fw"></i><?php echo $pageSensor ?> : <?php echo $day ?> </p>
        </div> <!-- col-lg-4 -->
		<div class="col-lg-4 pull-right">
            <div class="input-group">
                <span class="input-group-btn">      
                    <button class="btn btn-default" type="submit" form="submit" >Submit</button>
                </span>
					<form action="<?php echo $pageLink?>" id="date">
                        <input type="date" class="form-control" name="Day" placeholder="YYYY-MM-DD" maxlength= 10 value="<?php if(isset($_GET['Day'])){echo date_format($current, 'Y-m-d'); } ?>" >
                        <input type="hidden" name="sensorNumber" value="<?php echo $sensor_number ?>">
					</form>
            </div> <!-- input group -->
        </div> <!-- col-lg-4 pull-right -->
        </div> <!-- row -->
    </div> <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="lux-line-chart" style="height: 300px;"></div>
    </div> <!-- /.panel-body -->
</div> <!-- panel panel-default -->
