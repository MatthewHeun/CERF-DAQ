import Adafruit_I2C
from Adafruit_I2C import *
import re
import smbus
import TSL2561
import time

#==================================================================
#------------------------------LUX SENSOR--------------------------
#==================================================================
luxsensor1 = TSL2561.TSL2561()		#Initialize the sensor at i2c address 0x39
luxsensor1.setGain()			#Gain at deafault value of 1
time.sleep(1)

for x in range (0,10):

	print( luxsensor1.readLux() )	#Read out the raw value for the full spectrum reading
	time.sleep(1)
	