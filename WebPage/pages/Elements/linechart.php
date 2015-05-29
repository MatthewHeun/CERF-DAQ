<div class="panel panel-default">
                        <div class="panel-heading">
				<a href="<?php echo $pageLink ?>?Day=<?php echo $prev ?>"><h3 style=" margin: 0px; margin-right: 10px; padding: 0px; float: left;"><</h3></a> 
				<a href="<?php echo $pageLink ?>?Day=<?php echo $next ?>"><h3 style=" margin: 0px; margin-right: 10px; padding: 0px; float: left;"> ></h3></a> 
                            <i class="fa fa-bar-chart-o fa-fw"></i><?php echo $pageSensor ?> : <?php echo $day ?>
							<div class="pull-right">
							<form action="<?php echo $pageLink?>">
  							<input type="date" name="Day" placeholder="YYYY-MM-DD" maxlength= 10>
  							<input type="submit">
							</form>
							</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="lux-line-chart" style="height: 300px;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
