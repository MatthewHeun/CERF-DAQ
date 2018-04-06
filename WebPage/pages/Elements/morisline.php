new Morris.Area({
  			// ID of the element in which to draw the chart.
  			element: 'lux-line-chart',
			smooth: false,
			pointSize: 0,
			lineWidth: 0,
			grid: false,
			resize: true,
  			// Chart data records -- each entry in this array corresponds to a point on
  			// the chart.
 		 	data: <?php
                        $dayfilename = $Raw_Base . $day_file;
                        $lines = file($dayfilename);
                        $data = '[';
                            foreach($lines as $line){
                                if(substr($line, 0, 1) == "#"){
                                }else{
                                    list($pi_id, $sensor_id, $sensor_name, $utc_time, $time, $lux) = explode(',', $line);
                                    $data .= "{minute:'$time',lux: $lux},";
                                }
                            }
                        $data = rtrim($data, ',');
                        $data .= '],';
                        echo $data;
				?>
  			// The name of the data record attribute that contains x-values.
  			xkey: 'minute',
  			// A list of names of data record attributes that contain y-values.
  			ykeys: ['lux'],
  			// Labels for the ykeys -- will be displayed when you hover over the chart.
        
        <?php 

          if ($SENSOR_INFO[$sensor_number-1]->type == "Light") {
            echo 'labels: [\'LUX Value\']';
          } elseif ($SENSOR_INFO[$sensor_number-1]->type == "Temperature") {
            echo 'labels: [\'Temp Value [C]\']';
          } elseif ($SENSOR_INFO[$sensor_number-1]->type == "Occupancy") {
            echo 'labels: [\'Occupancy[1=Yes 0=No]\']';
          } elseif ($SENSOR_INFO[$sensor_number-1]->type == "Current") {
            echo 'labels: [\'Wattage [W]\']';
	  }

        ?>
		});
