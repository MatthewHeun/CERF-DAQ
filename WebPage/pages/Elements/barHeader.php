<div class="row">
<div class="col-lg-2 center-block">
	<form action="<?php echo $pageLink ?>" id="goToSensor">
		<div class="input-group">
			<span class="input-group-addon" style="background-color: #286090; color: rgb(255, 255, 255); border-color: #204D74" id="basic-addon1"><i class="fa fa-bar-chart-o fa-fw"></i></span>
			<button class="btn btn-primary" style="border-radius: 0px" type="submit" form="goToSensor"><?php echo $pageSensor ?> : <?php echo $year_sum ?></button>
			<span class="input-group-addon" style="background-color: #286090; color: rgb(255, 255, 255); border-color: #204D74" id="basic-addon1"><i class="fa fa-bar-chart-o fa-fw"></i></span>
		</div>
	</form>
</div>
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
</div>
<div class="col-lg-5 pull-right">
	<div class="input-group">
	<span class="input-group-btn">		
		<button class="btn btn-primary" type="submit" form="analysis<?php echo $sensor_number?>" >Submit</button>
	</span>
	<div class="form-group">
	<form action="<?php echo $pageLink?>" method="get" id="analysis<?php echo $sensor_number?>">
		<input type="hidden" name="sensorNumber" value="<?php echo($sensor_number)?>">
		<select style="width:75%;" class="form-control" name="analysis<?php echo $sensor_number?>">
			<?php if ($SENSOR_INFO[$sensor_number-1]->analysis == "Peak") {
				echo '<option selected="selected">On/Off Peak Analysis</option>' . "\n";
			} else {
				echo '<option>On/Off Peak Analysis</option>' . "\n";
			}
			if ($SENSOR_INFO[$sensor_number-1]->analysis == "Min-Max") {
				echo '<option selected="selected">Min/Max/Average Analysis</option>' . "\n";
			} else {
				echo '<option>Min/Max/Average Analysis</option>' . "\n";
			}
			if ($SENSOR_INFO[$sensor_number-1]->analysis == "Bins") {
				echo '<option selected="selected">Bin Analysis</option>' . "\n";
			} else {
				echo '<option>Bin Analysis</option>' . "\n";
			} ?>
		</select>
	</form>
	</div>
	</div>
</div>
</div>