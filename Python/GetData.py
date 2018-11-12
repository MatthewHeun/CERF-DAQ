# ********************************************************************** #
# CERF PI LUX CENSOR READINGS                                            #
#                                                                        #
# Takes in readings from the lux sensor and prints them to a file        #
#                                                                        #
# Created by Curtis Kortman                                              #
# Started: 3/15/15                                                       #
# Last Edited: 07/28/15                                                  #
# ********************************************************************** #

# **************************IMPORTS************************************* #
import time
import datetime
import re
import os
import pytz
import stat
import shutil
from globalVars import*		## Global Variables are defined in ALL CAPS for easy identification
#<<<<<<< HEAD

#==================================================================
#----------------------INITIALIZE VARIABLES------------------------
#==================================================================

##### Pi name
nameOfPi = str(PI_NUMBER)

##### Data path
cwd = os.path.dirname(os.path.abspath(__file__))
cwd = cwd[:-16]
path = cwd + "/Data" + '/Pi_' + nameOfPi + '_Raw/'		#Filepath for data storage
		
#==================================================================
#------------------------DEFINE FUNCTIONS--------------------------
#==================================================================

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
	if (SENSOR_INFO[sensor-1].type == "Light"):
 		sensorKey = "Light[Lux]"
	elif (SENSOR_INFO[sensor-1].type == "Temperature"):
		sensorKey = "Temperature[C]"
	elif (SENSOR_INFO[sensor-1].type == "Occupancy"):
		sensorKey = "Occupancy[1/0]"
	elif (SENSOR_INFO[sensor-1].type == "Current"):
		sensorKey = "Power[W]"
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
	SENSOR_INFO[sensor-1].set_value()
	return (nameOfPi + ',' + str(sensor) + ',' + SENSOR_INFO[sensor-1].name + ',' + time_utc + ',' + time_local + ',' + "%.2f" %float(SENSOR_INFO[sensor-1].value) + '\n')

#------------------------------------------------------------------

def writeData(sensor):
	createDirectories(sensor)
	fullpath = createFilePathMonth(sensor)
	os.chdir(fullpath)
	filename = createFilename(sensor)
	os.chmod(filename, stat.S_IWOTH | stat.S_IROTH)
	file = open(filename, 'a')
	file.write(dataString(sensor))		# write all time and sensor data to the file

#------------------------------------------------------------------

def outputData(numberOfSensors):
	for i in range(numberOfSensors):
		writeData(i + 1)

#==================================================================
#---------------------------GET DATA!!-----------------------------
#==================================================================
if RESET == 1:
	shutil.rmtree(path)
	resetPath = cwd + '/CERF-DAQ/WebPage/pages/reset.txt'
	file = open(resetPath, 'w')
	file.write('0')
	file.close()

if DATA_COLLECTION_SET == 1:
	 (NUM_SENSORS)

	# for i in range(NUM_SENSORS):
	#	print SENSOR_INFO[i].name + ": " + str(SENSOR_INFO[i].value)


#==================================================================
#------------TELL THE WEBSITE DATA COLLECTION STATUS---------------
#==================================================================

if DATA_COLLECTION_SET == 0:
	indicatorPath = cwd + '/CERF-DAQ/WebPage/pages/dataCollectionStatus.txt'
	file = open(indicatorPath, 'w')
	file.write('0')
	file.close()

if DATA_COLLECTION_SET == 1:
	indicatorPath = cwd + '/CERF-DAQ/WebPage/pages/dataCollectionStatus.txt'
	file = open(indicatorPath, 'w')
	file.write('1')
	file.close()

#==================================================================================
#------------------------KEEP THESE LINES FOR THE STATUS LOG-----------------------
#==================================================================================

if DATA_COLLECTION_SET == 1:
	print "Data collection succeeded:" +  str(datetime.datetime.now())

if DATA_COLLECTION_SET == 0:
	print "Data collection paused:" + str(datetime.datetime.now())

# The status log is found in /dev/GetDataCron.log




