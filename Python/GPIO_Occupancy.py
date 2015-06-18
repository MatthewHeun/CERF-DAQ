import RPi.GPIO as GPIO
import time
import os
from global_vars import *

debug = True

if debug == True:
	print GPIO.VERSION

#==================================================================
#----------------------------INITIALIZATION------------------------
#==================================================================

GPIO.setmode(GPIO.BOARD) 			#Tell the pi to use the board numbering of pins

Occupancy_Value = [0] * 16
GPIO_pins = [7,8,10,11,12,13,15,16,18,19,21,22,23,24,26,29]

for i in range(Number_of_Occupancy_Sensors):
	GPIO.setup(GPIO_pins[i], GPIO.IN)

#==================================================================
#------------------------------READ DATA---------------------------
#==================================================================

for x in range(58):
	for i in range(Number_of_Occupancy_Sensors):
		Occupancy_Value[i] += GPIO.input(GPIO_pins[i])
		if debug:
			print ("Raw: " + str(GPIO.input(GPIO_pins[i])))
			print ("New Value: " + str(Occupancy_Value[i]))
	time.sleep(1)

Occupant = [0] * 16

for i in range(Number_of_Occupancy_Sensors):
	if Occupancy_Value[i] > 1:
		Occupant[i] = 1
	else:
		Occupant[i] = 0

f = open('/home/pi/Desktop/CERF-DAQ/Python/Occupancy_vars.py', 'w')
f.write("Occupancy = [")

for i in range(Number_of_Occupancy_Sensors):
	if i != Number_of_Occupancy_Sensors - 1:
		f.write(str(Occupant[i]) + ", ")
	else:
		f.write(str(Occupant[i]))

f.write("]")
f.close()