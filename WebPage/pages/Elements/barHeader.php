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
            <div class="btn-group btn-block" role="group">
                <div class="btn-group">
                    <button class="btn btn-primary" type="submit" form="goToPrevYear"><i class="fa fa-chevron-left fa-fw" ></i></button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-primary" style="border-radius: 0px" type="submit" form="goToSensor"><?php echo $pageSensor ?> : <?php echo $year_sum ?></button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-primary" type="submit" form="goToNextYear"><i class="fa fa-chevron-right fa-fw"></i></button>
                </div>
            </div>
        </div> <!-- col-lg-4 -->

<div class="col-lg-4 pull-right">
	<div class="input-group">
		<span class="input-group-btn">		
			<button class="btn btn-primary" type="submit" form="submit" >Submit</button>
		</span>
		<form action="<?php echo $pageLink?>" method="get" id="submit">
			<input type="text" class="form-control" name="Year" placeholder="Enter Year" maxlength= 4 value="<?php if(isset($_GET['Year'])){ $year_sum = $_GET['Year']; echo $year_sum; } ?>">
			<input type="hidden" name="sensorNumber" value="<?php echo($sensor_number)?>">
		</form>
	</div> <!-- input-group -->
</div> <!-- col-lg-4 pull-right -->

</div>