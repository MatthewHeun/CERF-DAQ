# import RPi.GPIO as GPIO
import time
import os
from Adafruit_ADS1x15 import ADS1x15
import ADS1x15tempFix
from Occupancy_vars import *

# RPi.GPIO is used for finding wattage, currently unit tests cannot be run with this being imported
cwd = os.getcwd()
amTestFile = cwd + "/UnitTest/amTest.txt"
f = open(amTestFile)
amTest = int(f.readline())
f.close()
if not amTest:
	import RPi.GPIO as GPIO


#==================================================================
#----------------------INITIALIZE VARIABLES------------------------
#==================================================================
									#Define the type of ADC to be used
ADS1115 = 0x01						#16-bit ADC defined (would be 0x00 for the 12bit ADC)

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
		#print "pinNumber: " + str(pinNumber)
		#This comes from the occupancy vars file. The file has the current occupancy status stored in it. It the Occuoancy vars file is written by the GPIO_Occupancy file.
	value = Occupancy[str(pinNumber)] 
	return value

def getWattage(sensorNum, voltage):
	adc = ADS1x15tempFix.ADS1115()
	GAIN = 1
	value = adc.read_adc((sensorNum-1), gain = GAIN)
	
	# These values are 'magic numbers' found by testing the adc's. They will eventually be configurable
	# However, I am still figuring out how to do that. These numbers will work for the 
	value = (((float(value)/32767) * 4.096) - .0175) / .025
	value = value * voltage
		#print "pinNumber: " + str(self.pinNumber)
		#GPIO.setmode(GPIO.BOARD)
		#GPIO.setup(int(self.pinNumber), GPIO.IN, pull_up_down = GPIO.PUD_DOWN)
		#print(self.pinNumber)
		#print(GPIO.input(int(self.pinNumber)))
		#print(self.wattage)
		#value = (float(GPIO.input(int(self.pinNumber))) * float(self.wattage))
		#print(value)
	return value


#==================================================================
#------------------------CLASS DEFINITION--------------------------
#==================================================================

class Sensor:
	def __init__(self, sensorNumber):
		self.name = ""
		self.type = ""
		self.i2cAddress = 0
		self.pinNumber = 0
		self.numberOfAnalysis = 0
		self.analysis = ["","",""]
		self.thresholdMin = [0,0,0]
		self.thresholdMax = [0,0,0]
		self.number = sensorNumber
		self.value = [0,0,0]
		self.binType = ["","",""]
		self.fromSensorNumber = [0,0,0]
		self.fromSensorMin = [0,0,0]
		self.fromSensorMax = [0,0,0]
		self.weekdays = [[0,0,0,0,0,0,0],[0,0,0,0,0,0,0],[0,0,0,0,0,0,0]]
		self.customStart = [0,0,0]
		self.customStop = [0,0,0]
		self.summaryMethod = ["","",""]
		self.numberOfAnalysis = 0
		self.wattage = 0
		self.voltage = 0

	def set_name(self, new_name):
		self.name = new_name

	def set_type(self, new_type):
		self.type = new_type

	def set_i2cAddress(self, new_address):
		self.i2cAddress = new_address

	def set_pinNumber(self, new_pinNumber):
		self.pinNumber = new_pinNumber
	
	def set_numberOfAnalysis(self, new_number):
		# How many analysis will be done i.e. (1. peak analysis 2. range analysis 3. 
		self.numberOfAnalysis = new_number

	def set_analysis(self, new_analysis, index):
		self.analysis[index] = new_analysis

	def set_peak(self, new_peak_start, new_peak_stop, index):
		self.peakStart[index] = new_peak_start
		self.peakStop[index] = new_peak_stop

	def set_threshold(self, new_threshold_min, new_threshold_max, index):
		self.thresholdMin[index] = new_threshold_min
		self.thresholdMax[index] = new_threshold_max

	def set_value(self):
		reading = 0
		if (self.type == "Light"):
			reading = getLight(self.i2cAddress, self.pinNumber)
		elif (self.type == "Temperature"):
			reading = getTemperature(self.i2cAddress, self.pinNumber)
		elif (self.type == "Occupancy"):
			reading = getOccupancy(self.pinNumber)
		elif (self.type == "Current"):
			reading = 0
			if (getWattage(self.number) > 0):
				# Get wattage uses the wattage value while pretending it is a voltage value. This will eventually
				# be configured properly, however, I am still figuring out how to do that.
				reading = getWattage(self.number, self.wattage)
		self.value = reading

	def set_binType(self, new_binType, index):
		self.binType[index] = new_binType

	def set_fromSensorNumber(self, new_fromSensorNumber, index):
		self.fromSensorNumber[index] = new_fromSensorNumber

	def set_fromSensorMin(self, new_fromSensorMin, index):
		self.fromSensorMin[index] = new_fromSensorMin

	def set_fromSensorMax(self, new_fromSensorMax, index):
		self.fromSensorMax[index] = new_fromSensorMax

	def set_weekdays(self, new_M, new_T, new_W, new_Th, new_F, new_Sa, new_Su, index):
		self.weekdays[index][0] = new_M
		self.weekdays[index][1] = new_T
		self.weekdays[index][2] = new_W
		self.weekdays[index][3] = new_Th
		self.weekdays[index][4] = new_F
		self.weekdays[index][5] = new_Sa
		self.weekdays[index][6] = new_Su

	def set_customStartStop(self, new_customStart, new_customStop, index):
		self.customStart[index] = new_customStart
		self.customStop[index] = new_customStop

	def set_summaryMethod(self, new_summaryMethod, index):
		self.summaryMethod[index] = new_summaryMethod
	
	# Currently working on moving over to setting voltage. Currently the wattage setting stands in as the voltage
	# I'm still learning how to get rid of magic numbers and make everything configurable from the website
	def set_wattage(self, new_wattage):
		self.wattage = new_wattage
	
	# Eventually this function will replace the wattage function. Still figuring out how to manage that.	
	# Otherwise the wattage should be properly calculated if one pretends self.wattage is actually the voltage
	# of the line.
	def set_voltage(self, new_voltage):
		self.voltage = new_voltage

#testSensor = Sensor(8)
#testSensor.set_type("Wattage")
#testSensor.set_pinNumber(8)
#testSensor.set_value()	

