# ********************************************************************** #
# CERF PI LUX CENSOR READINGS                                            #
#                                                                        #
# Takes in readings from the lux sensor and prints them to a file        #
#                                                                        #
# Created by Curtis Kortman                                              #
# Started: 3/15/15                                                       #
# Last Edited: 09/06/15                                                  #
# ********************************************************************** #

# **************************IMPORTS************************************* #
import time
import datetime
import re
import os
import pytz
from Adafruit_ADS1x15 import ADS1x15
from global_vars import*		## Global Variables are defined in ALL CAPS for easy identification
from Occupancy_vars import*
#<<<<<<< HEAD

#==================================================================
#----------------------INITIALIZE VARIABLES------------------------
#==================================================================

##### Pi name
nameOfPi = str(PI_NUMBER)

##### Data holders
volts = [0] * NUM_TEMP_AND_LIGHT
value = [0] * TOTAL_SENSORS

##### Data path
path = '/home/pi/Desktop/Data/Pi_' + nameOfPi + '_Raw/'		#Filepath for data storage
		
#==================================================================
#------------------------INITIALIZE ADC's--------------------------
#==================================================================

				#Define type
ADS1115 = 0x01			#16-bit ADC (would be 0x00 for the 12bit ADC)

				#Initialize ADC0: always (Default address 0x48)
adc0 = ADS1x15(ic = ADS1115)
				#Initialize ADC1: if there are more than four sensors (address 0x49 - addr pin connected to VDD)
if NUM_TEMP_AND_LIGHT > 4:
	adc1 = ADS1x15(ic = ADS1115, address = 0x49)
				#Initialize ADC2: if there are more than eight sensors (address 0x4a - addr pin connected to SDA)
if NUM_TEMP_AND_LIGHT > 8:
	adc2 = ADS1x15(ic = ADS1115, address = 0x4A)
				#Initialize ADC3: if there are more than twelve sensors (address 0x4b - addr pin connected to SDA)
if NUM_TEMP_AND_LIGHT > 12:
	adc3 = ADS1x15(ic = ADS1115, address = 0x4B)

#==================================================================
#------------------------DEFINE FUNCTIONS--------------------------
#==================================================================

def readVoltage(sensorNumber):	
	if sensorNumber < 4:
		value = adc0.readADCSingleEnded(sensorNumber, 4096, 250) / 1000
	elif sensorNumber < 8:
		value = adc1.readADCSingleEnded(sensorNumber-4, 4096, 250) / 1000
	elif sensorNumber < 12:
		value = adc2.readADCSingleEnded(sensorNumber-8, 4096, 250) / 1000
	elif sensorNumber < 16:
		value = adc3.readADCSingleEnded(sensorNumber-12, 4096, 250) /1000
	return value
#------------------------------------------------------------------

				#Only read as many as there are sensors
def readVolts():		
	for i in range(NUM_TEMP_AND_LIGHT):
		volts[i] = readVoltage(i)

#------------------------------------------------------------------

def convertVolts():
	for i in range(NUM_TEMP_AND_LIGHT): 
		if SENSOR_TYPES[i] == "Light":
			value[i] = pow(10, volts[i])
		elif SENSOR_TYPES[i] == "Temperature":
			value[i] = (100 * volts[i]) - 50

def readOccupancy():
	for i in range(NUM_OCCUPANCY):
		value[i+NUM_TEMP_AND_LIGHT] = Occupancy[i]

#------------------------------------------------------------------

def createFilePathSensor(sensor):
	return (path + 'Sensor' + str(sensor))

#------------------------------------------------------------------

def createFilePathYear(sensor):
	return (createFilePathSensor(sensor) + '/' + datetime.datetime.strftime(datetime.datetime.now(), '%Y'))

#------------------------------------------------------------------

def createFilePathMonth(sensor):
	return (createFilePathYear(sensor) + '/' + datetime.datetime.strftime(datetime.datetime.now(), '%m'))

#------------------------------------------------------------------

def checkDir(fullpath):
	if not os.path.exists(fullpath):
		os.makedirs(fullpath)

#------------------------------------------------------------------

def createFilename(sensor):
	return ('Pi_' + nameOfPi + '_' + str(sensor) + '_' + datetime.datetime.strftime(datetime.datetime.now(), '%Y-%m-%d') + '.csv')

#------------------------------------------------------------------

def createMetadata(sensor):
	if (SENSOR_TYPES[sensor-1] == "Light"):
 		sensorKey = "Light[Lux]"
	elif (SENSOR_TYPES[sensor-1] == "Temperature"):
		sensorKey = "Temperature[C]"
	elif (SENSOR_TYPES[sensor-1] == "Occupancy"):
		sensorKey = "Occupancy[1/0]"
	return ("#Pi_Number,str(sensor),Descriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local]," + sensorKey + '\n')

#------------------------------------------------------------------

def createDirectories(sensor):

	fullpath = createFilePathSensor(sensor)	# path to the Desktop Data directory
    
	checkDir(fullpath)   			# creates the Data directory if it does not exist
        											
	fullpath = createFilePathYear(sensor)	# changes the filepath to include a year
        
	checkDir(fullpath)		 	# creates the year folder if it does not exist
    												
	fullpath = createFilePathMonth(sensor)	# changes the filepath to include a month
        
	checkDir(fullpath)		 	# creates the month folder if it does not exist
        
	os.chdir(fullpath) 			# navigate into the sensor and year folder

	filename = createFilename(sensor)	# create a file for the day if it does not exist, else open for appending

						# create a header line with metadata
	if not os.path.isfile(filename):
		file = open(filename, 'w')
		file.write("#Calvin College CERF PI DATA"+ '\n')
		file.close()
		file = open(filename, 'a')
		file.write(createMetadata(sensor))

#------------------------------------------------------------------

def dataString(sensor):
	local = pytz.timezone("America/Detroit")
	naive = datetime.datetime.now()
	local_dt = local.localize(naive, is_dst = None)
	time_local = datetime.datetime.strftime(datetime.datetime.now(), '%Y-%m-%d %H:%M:%S')
	time_utc = datetime.datetime.strftime(local_dt.astimezone(pytz.utc), '%Y-%m-%dT%H:%M:%S')
	return (nameOfPi + ',' + str(sensor) + ',' + SENSOR_NAMES[sensor-1] + ',' + time_utc + ',' + time_local + ',' + "%.2f" %value[sensor-1] + '\n')

#------------------------------------------------------------------

def writeData(sensor):
	createDirectories(sensor)
	fullpath = createFilePathMonth(sensor)
	os.chdir(fullpath)
	filename = createFilename(sensor)
	file = open(filename, 'a')
	file.write(dataString(sensor))		# write all time and sensor data to the file

#------------------------------------------------------------------

def outputData(numberOfSensors):
	for i in range(numberOfSensors):
		writeData(i + 1)

#==================================================================
#---------------------------GET DATA!!-----------------------------
#==================================================================

readVolts()
convertVolts()
readOccupancy()
outputData(TOTAL_SENSORS)

for i in range(TOTAL_SENSORS):
	print SENSOR_TYPES[i] + ": " + str(value[i])








