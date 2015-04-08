import Adafruit_I2C
from Adafruit_I2C import *
import re
import smbus

#==================================================================
#------------------------------LUX SENSOR--------------------------
#==================================================================

class luxSensor:

	def _init_(self, address = 0x39, debug = False):
		if (debug):
			print "Initializing a new instance of luxSensor at 0x%02X" % address
	