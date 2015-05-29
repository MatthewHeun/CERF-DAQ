from global_vars import*  # Global vars
import os

f = open('/home/pi/Desktop/CERF-DAQ/WebPage/pages/global_vars.php', 'w')


f.write('<?php\n')
f.write('$Pi_Number= "' + str(Pi_Number) + '";\n')
f.write('$NUMBER_OF_SENSORS= ' + str(Number_of_Sensors) + ';\n') 
f.write('$SENSOR1= "'+Sensor_1 +'";\n')
f.write('$SENSOR2= "'+Sensor_2 +'";\n')
f.write('$SENSOR3= "'+Sensor_3 +'";\n')
f.write('$SENSOR4= "'+Sensor_4 +'";\n')
f.write('$SENSOR5= "'+Sensor_5 +'";\n')
f.write('$SENSOR6= "'+Sensor_6 +'";\n')
f.write('$SENSOR7= "'+Sensor_7 +'";\n')
f.write('$SENSOR8= "'+Sensor_8 +'";\n')
f.write('$SENSOR9= "'+Sensor_9 +'";\n')
f.write('$SENSOR10= "'+Sensor_10 +'";\n')
f.write('$SENSOR11= "'+Sensor_11 +'";\n')
f.write('$SENSOR12= "'+Sensor_12 +'";\n')
f.write('$SENSOR13= "'+Sensor_13 +'";\n')
f.write('$SENSOR14= "'+Sensor_14 +'";\n')
f.write('$SENSOR15= "'+Sensor_15 +'";\n')
f.write('$SENSOR16= "'+Sensor_16 +'";\n')
f.write('?>\n')
