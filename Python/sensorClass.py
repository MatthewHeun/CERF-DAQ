import RPi.GPIO as GPIO
import time
import os
from Adafruit_ADS1x15 import ADS1x15
from Occupancy_vars import *

#==================================================================
#----------------------INITIALIZE VARIABLES------------------------
#==================================================================

									#Define the type of ADC to be used
ADS1115 = 0x01								#16-bit ADC defined (would be 0x00 for the 12bit ADC)


#==================================================================
#----------------------FUNCTION DEFINITIONS------------------------
#==================================================================

def getLight(i2cAddress, pinNumber):
	adc = ADS1x15(ic = ADS1115, address = int(i2cAddress, 16))
	voltage = adc.readADCSingleEnded(int(pinNumber), 4096, 250) / 1000
	value  = pow(10, voltage)
	return value

def getTemperature(i2cAddress, pinNumber):
	adc = ADS1x15(ic = ADS1115, address = int(i2cAddress, 16))
	voltage = adc.readADCSingleEnded(int(pinNumber), 4096, 250) / 1000
	value  = (100 * voltage) - 50
	return value

def getOccupancy(pinNumber):
	print "pinNumber: " + str(pinNumber)
	value = Occupancy[str(pinNumber)]
	return value


#==================================================================
#------------------------CLASS DEFINITION--------------------------
#==================================================================

class Sensor:
	def __init__(self, sensorNumber):
		self.name = ""
		self.type = ""
		self.analysis = ""
		self.peakStart = 0
		self.peakStop = 0
		self.thresholdMin = 0
		self.thresholdMax = 0
		self.number = sensorNumber
		self.i2cAddress = 0
		self.pinNumber = 0
		self.value = 0

	def set_name(self, new_name):
		self.name = new_name

	def set_type(self, new_type):
		self.type = new_type

	def set_analysis(self, new_analysis):
		self.analysis = new_analysis

	def set_peak(self, new_peak_start, new_peak_stop):
		self.peakStart = new_peak_start
		self.peakStop = new_peak_stop

	def set_threshold(self, new_threshold_min, new_threshold_max):
		self.thresholdMin = new_threshold_min
		self.thresholdMax = new_threshold_max

	def set_i2cAddress(self, new_address):
		self.i2cAddress = new_address

	def set_pinNumber(self, new_pinNumber):
		self.pinNumber = new_pinNumber

	def set_value(self):
		reading = 0
		if (self.type == "Light"):
			reading = getLight(self.i2cAddress, self.pinNumber)
		elif (self.type == "Temperature"):
			reading = getTemperature(self.i2cAddress, self.pinNumber)
		elif (self.type == "Occupancy"):
			reading = getOccupancy(self.pinNumber)
		self.value = reading

