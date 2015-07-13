<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
        <div class="col-lg-4">
            <form action="<?php echo $pageLink?>" id="goToPrev">
                <input type="hidden" name="sensorNumber" value="<?php echo $sensor_number ?>">
                <input type="hidden" name="Day" value="<?php echo $prev ?>">
            </form>
            <form action="<?php echo $pageLink?>" id="goToNext">
                <input type="hidden" name="sensorNumber" value="<?php echo $sensor_number ?>">
                <input type="hidden" name="Day" value="<?php echo $next ?>">
            </form>
            <form action="<?php echo $pageLink?>" id="goToSensor">
                <input type="hidden" name="sensorNumber" value="<?php echo $sensor_number ?>">
            </form>
            <div class="btn-group btn-block" role="group">
                <div class="btn-group">
                    <button class="btn btn-primary" type="submit" form="goToPrev"><i class="fa fa-chevron-left fa-fw" ></i></button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-primary" style="border-radius: 0px" type="submit" form="goToSensor"><?php echo $pageSensor ?> : <?php echo $day ?></button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-primary" type="submit" form="goToNext"><i class="fa fa-chevron-right fa-fw"></i></button>
                </div>
            </div>
        </div> <!-- col-lg-4 -->
		<div class="col-lg-4 pull-right">
            <div class="input-group">
                <form action="<?php echo $pageLink?>" id="date">
                    <input type="date" class="form-control" name="Day" placeholder="YYYY-MM-DD" maxlength= 10 value="<?php if(isset($_GET['Day'])){echo date_format($current, 'Y-m-d'); } ?>" >
                    <input type="hidden" name="sensorNumber" value="<?php echo $sensor_number ?>">
                    <span class="input-group-btn">      
                        <button class="btn btn-primary" type="submit" form="date" >Submit</button>
                    </span>
				</form>
            </div> <!-- input group -->
        </div> <!-- col-lg-4 pull-right -->
        </div> <!-- row -->
    </div> <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="lux-line-chart" style="height: 300px;"></div>
    </div> <!-- /.panel-body -->
</div> <!-- panel panel-default -->
