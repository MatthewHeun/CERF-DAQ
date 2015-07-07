# import RPi.GPIO as GPIO
import time
import os
# from Adafruit_ADS1x15 import ADS1x15
# from Occupancy_vars import *

#==================================================================
#----------------------INITIALIZE VARIABLES------------------------
#==================================================================

									#Define the type of ADC to be used
ADS1115 = 0x01								#16-bit ADC defined (would be 0x00 for the 12bit ADC)


#==================================================================
#----------------------FUNCTION DEFINITIONS------------------------
#==================================================================

# def getLight(i2cAddress, pinNumber):
# 	adc = ADS1x15(ic = ADS1115, address = int(i2cAddress, 16))
# 	voltage = adc.readADCSingleEnded(int(pinNumber), 4096, 250) / 1000
# 	value  = pow(10, voltage)
# 	return value

# def getTemperature(i2cAddress, pinNumber):
# 	adc = ADS1x15(ic = ADS1115, address = int(i2cAddress, 16))
# 	voltage = adc.readADCSingleEnded(int(pinNumber), 4096, 250) / 1000
# 	value  = (100 * voltage) - 50
# 	return value

# def getOccupancy(pinNumber):
# 	print "pinNumber: " + str(pinNumber)
# 	value = Occupancy[str(pinNumber)]
# 	return value


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
		self.binType = ""
		self.fromSensorNumber = 0
		self.fromSensorMin = 0
		self.fromSensorMax = 0
		self.weekdays = [0,0,0,0,0,0,0]
		self.customStart = 0
		self.customStop = 0
		self.summaryMethod = ""

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

	def set_binType(self, new_binType):
		self.binType = new_binType

	def set_fromSensorNumber(self, new_fromSensorNumber):
		self.fromSensorNumber = new_fromSensorNumber

	def set_fromSensorMin(self, new_fromSensorMin):
		self.fromSensorMin = new_fromSensorMin

	def set_fromSensorMax(self, new_fromSensorMax):
		self.fromSensorMax = new_fromSensorMax

	def set_weekdays(self, new_M, new_T, new_W, new_Th, new_F, new_Sa, new_Su):
		self.weekdays[0] = new_M
		self.weekdays[1] = new_T
		self.weekdays[2] = new_W
		self.weekdays[3] = new_Th
		self.weekdays[4] = new_F
		self.weekdays[5] = new_Sa
		self.weekdays[6] = new_Su

	def set_customStartStop(self, new_customStart, new_customStop):
		self.customStart = new_customStart
		self.customStop = new_customStop

	def set_summaryMethod(self, new_summaryMethod):
		self.summaryMethod = new_summaryMethod
	

