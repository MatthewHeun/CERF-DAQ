<div class="row">

<div class="col-lg-4">
            <form action="<?php echo $pageLink?>" id="goToPrevYear">
                <input type="hidden" name="sensorNumber" value="<?php echo $sensor_number ?>">
                <input type="hidden" name="Year" value="<?php echo $prevYear ?>">
            </form>
            <form action="<?php echo $pageLink?>" id="goToNextYear">
                <input type="hidden" name="sensorNumber" value="<?php echo $sensor_number ?>">
                <input type="hidden" name="Year" value="<?php echo $nextYear ?>">
            </form>
            <form action="<?php echo $pageLink?>" id="goToSensor">
                <input type="hidden" name="sensorNumber" value="<?php echo $sensor_number ?>">
            </form>
            <div class="btn-group btn-block" role="group" style="width:90%; margin-left:5%;">
                <div class="btn-group" style="width:15%;">
                    <button class="btn btn-primary" type="submit" form="goToPrevYear" style="width:100%;"><i class="fa fa-chevron-left fa-fw" ></i></button>
                </div>
                <div class="btn-group" style="width:70%;">
                    <button class="btn btn-primary" style="border-radius:0px; width:100%;" type="submit" form="goToSensor" ><?php echo $pageSensor ?> : <?php echo $year_sum ?></button>
                </div>
                <div class="btn-group" style="width:15%;">
                    <button class="btn btn-primary" type="submit" form="goToNextYear" style="width:100%;"><i class="fa fa-chevron-right fa-fw"></i></button>
                </div>
            </div>
        </div> <!-- col-lg-4 -->
<div class="col-lg-4">
    <div style="width:90%; margin-left:5%; text-align:center; padding:6px 12px; background-color:#5BC0DE; border-color:#2E6DA4; border-radius:4px; border:1px solid transparent; color:#FFF"> <?php echo $SENSOR_INFO[$sensor_number-1]->analysis[$k]; ?> </div>
</div>
<div class="col-lg-4">
	<div class="input-group" style="width:68%; margin-left:5%">
		<form action="<?php echo $pageLink?>" method="get" id="submit">
			<input type="text" class="form-control" name="Year" placeholder="Enter Year" maxlength= 4 value="<?php if(isset($_GET['Year'])){ $year_sum = $_GET['Year']; echo $year_sum; } ?>">
			<input type="hidden" name="sensorNumber" value="<?php echo($sensor_number)?>">
            <span class="input-group-btn">      
                <button class="btn btn-primary" type="submit" form="submit" >Submit</button>
            </span>
		</form>
	</div> <!-- input-group -->
</div> <!-- col-lg-4 pull-right -->

</div>