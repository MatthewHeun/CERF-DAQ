### This file is separate from getData because it reads in the data from the occupancy sensor almost continuously. It would therefore make getData run
### continuously which would make it hard for the chron job to call it every minute, or multiple instances of it might start, therefore the 
### polling of the occupancy sensors is done by this file. 


import RPi.GPIO as GPIO
import time
import os
from globalVars import *

debug = False

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

for x in range(58): 									# The occupancy sensors are polled 59 times at 1 second intervals
	for key in occupancyData:
		occupancyData[key] += GPIO.input(int(key))		#Associate the pin number of the occupancy sensor with an array value
		if debug:										# increment that key value each time the occupency sensor reads occupied 
			print ("Raw: " + str(GPIO.input(int(key))))
			print ("New Value: " + str(occupancyData[key]))
	time.sleep(1)										# pause for 1 second 

for key in occupancyData:								#if the occupancy sensor reads occupied for 2 seconds or more during the 59 readings, mark 
	if occupancyData[key] > 1:							# that minute as occupied. 
		occupancyData[key] = 1
	else:
		occupancyData[key] = 0

f = open('/home/pi/Desktop/CERF-DAQ/Python/Occupancy_vars.py', 'w')
f.write("Occupancy = {")

for key in sorted(occupancyData.keys()):				#write this data to the occupancy vars file. 
	if key != max(occupancyData.keys()):
		f.write("'" + str(key) + "' :" + str(occupancyData[key]) + ", ")
	else:
		f.write("'" + str(key) + "' :" + str(occupancyData[key]))

f.write("}")
f.close()