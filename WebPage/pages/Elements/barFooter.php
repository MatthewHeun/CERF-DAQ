<div class="row">
<div class="col-lg-3"></div>
<div class="col-lg-6">
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
	</div> <!-- form group -->
	</div> <!-- input group -->
</div> <!-- col-lg-6-->
<div class="col-lg-3"></div>
</div> <!-- row -->