import RPi.GPIO as GPIO
import time
import os
from globalVars import *

debug = True

if debug == True:
	print GPIO.VERSION

#==================================================================
#----------------------------INITIALIZATION------------------------
#==================================================================

GPIO.setmode(GPIO.BOARD) 			#Tell the pi to use the board numbering of pins

occupancyData = dict()

for i in range(NUM_SENSORS):
	if SENSOR_INFO[i].type == "Occupancy":
		print(SENSOR_INFO[i].pinNumber)
		GPIO.setup(int(SENSOR_INFO[i].pinNumber), GPIO.IN)
		occupancyData[str(SENSOR_INFO[i].pinNumber)] = 0


#==================================================================
#------------------------------READ DATA---------------------------
#==================================================================

for x in range(58):
	for key in occupancyData:
		occupancyData[key] += GPIO.input(int(key))
		if debug:
			print ("Raw: " + str(GPIO.input(int(key))))
			print ("New Value: " + str(occupancyData[key]))
	time.sleep(1)

for key in occupancyData:
	if occupancyData[key] > 1:
		occupancyData[key] = 1
	else:
		occupancyData[key] = 0

f = open('/home/pi/Desktop/CERF-DAQ/Python/Occupancy_vars.py', 'w')
f.write("Occupancy = {")

for key in sorted(occupancyData.keys()):
	if key != max(occupancyData.keys()):
		f.write("'" + str(key) + "' :" + str(occupancyData[key]) + ", ")
	else:
		f.write("'" + str(key) + "' :" + str(occupancyData[key]))

f.write("}")
f.close()