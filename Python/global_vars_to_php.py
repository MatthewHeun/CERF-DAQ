from global_vars import*  # Global vars
import os

f = open('/home/pi/Desktop/CERF-DAQ/WebPage/pages/global_vars.php', 'w')


f.write('<?php\n')
f.write('$Pi_Number= "' + str(Pi_Number) + '";\n')
f.write('$NUMBER_OF_SENSORS= ' + str(TOTAL_SENSORS) + ';\n') 
f.write('\n')


f.write('$SENSOR_NAMES = array(')

for i in range(TOTAL_SENSORS):
	if i != TOTAL_SENSORS - 1:
		f.write('"' + SENSOR_NAMES[i] + '"' + ', ')
	else:
		f.write('"' + SENSOR_NAMES[i] + '"' + ');' + '\n')

f.write('$SENSOR_TYPES = array(')

for i in range(TOTAL_SENSORS):
	if i != TOTAL_SENSORS -1:
		f.write('"' + SENSOR_TYPES[i] + '"' + ', ')
	else:
		f.write('"' + SENSOR_TYPES[i] + '"' + ');' + '\n')

f.write('$ANALYSIS_TYPES = array(')

for i in range(TOTAL_SENSORS):
	if i != TOTAL_SENSORS - 1:
		f.write('"' + ANALYSIS_TYPES[i] + '"' + ', ')
	else: 
		f.write('"' + SENSOR_TYPES[i] + '"' + ');' + '\n')

f.write('\n')
f.write('?>\n')
