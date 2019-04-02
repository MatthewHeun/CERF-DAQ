from sensorClass import *
import os

cwd = os.path.dirname(os.path.abspath(__file__))
cwd = cwd[:-7]

numPiFile = cwd + "/WebPage/pages/piNumber.txt"
#numPiFile = "/home/pi/Desktop/CERF-DAQ/WebPage/pages/piNumber.txt"

f = open(numPiFile)

PI_NUMBER = int(f.readline())

f.close()

numSensorFile = cwd + "/WebPage/pages/numSensors.txt"
#numSensorFile = "/home/pi/Desktop/CERF-DAQ/WebPage/pages/numSensors.txt"

f = open(numSensorFile)

NUM_SENSORS = int(f.readline())

f.close()

dataCollectionSetFile = cwd + "/WebPage/pages/dataCollectionSet.txt"
#dataCollectionSetFile = "/home/pi/Desktop/CERF-DAQ/WebPage/pages/dataCollectionSet.txt"

f = open(dataCollectionSetFile)

DATA_COLLECTION_SET = int(f.readline())

f.close()

resetFile = cwd + "/WebPage/pages/reset.txt"
#resetFile = "/home/pi/Desktop/CERF-DAQ/WebPage/pages/reset.txt"

f = open(resetFile)

RESET = int(f.readline())

f.close()

# The website generates onPeakOffPeakTime.txt for user-created times, however is unused
# here for the new peak times. Maybe consider adding the ability to add multiple times?

onPeakOffPeakTimeFile = cwd + "/WebPage/pages/newPeakTimes.txt"
#onPeakOffPeakTimeFile = "/home/pi/Desktop/CERF-DAQ/WebPage/pages/newPeakTimes.txt"

f = open(onPeakOffPeakTimeFile)

START_TIME = f.readline().strip()
if (len(START_TIME) != 0): 			 # line 1
	START_TIME = int(START_TIME)
	
START_TIME_LOW_summer = f.readline().strip()
if (len(START_TIME_LOW_summer) != 0): 			 # line 2
	START_TIME_LOW_summer = int(START_TIME_LOW_summer)

START_TIME_MID_summer = f.readline().strip()
if (len(START_TIME_MID_summer) != 0): 			 # line 3
	START_TIME_MID_summer = int(START_TIME_MID_summer)

START_TIME_HIGH_summer = f.readline().strip()
if (len(START_TIME_HIGH_summer) != 0): 			 # line 4
	START_TIME_HIGH_summer = int(START_TIME_HIGH_summer)

STOP_TIME_HIGH_summer = f.readline().strip()
if (len(STOP_TIME_HIGH_summer) != 0): 			 # line 5
	STOP_TIME_HIGH_summer = int(STOP_TIME_HIGH_summer)

STOP_TIME_MID_summer = f.readline().strip()
if (len(STOP_TIME_MID_summer) != 0): 			 # line 6
	STOP_TIME_MID_summer = int(STOP_TIME_MID_summer)

STOP_TIME_LOW_summer = f.readline().strip()
if (len(STOP_TIME_LOW_summer) != 0): 			 # line 7
	STOP_TIME_LOW_summer = int(STOP_TIME_LOW_summer)
	
START_TIME_MID_winter = f.readline().strip()
if (len(START_TIME_MID_winter) != 0): 			 # line 8
	START_TIME_MID_winter = int(START_TIME_MID_winter)

START_TIME_HIGH_winter = f.readline().strip()
if (len(START_TIME_HIGH_winter) != 0): 			 # line 9
	START_TIME_HIGH_winter = int(START_TIME_HIGH_winter)

STOP_TIME_HIGH_winter = f.readline().strip()
if (len(STOP_TIME_HIGH_winter) != 0): 			 # line 10
	STOP_TIME_HIGH_winter = int(STOP_TIME_HIGH_winter)
	
STOP_TIME_MID_winter = f.readline().strip()
if (len(STOP_TIME_MID_winter) != 0): 			 # line 11
	STOP_TIME_MID_winter = int(STOP_TIME_MID_winter)

STOP_TIME = f.readline().strip()
if (len(STOP_TIME) != 0): 			 # line 12
	STOP_TIME = int(STOP_TIME)

PEAK_WEEKDAY = []

for w in range(7):
	PEAK_WEEKDAY.append(f.readline().strip())
	if len(PEAK_WEEKDAY[w]) != 0:
		PEAK_WEEKDAY[w] = int(PEAK_WEEKDAY[w])

f.close()

sensorInfoFile = cwd + "/WebPage/pages/sensorInfo.txt"
#sensorInfoFile = "/home/pi/Desktop/CERF-DAQ/WebPage/pages/sensorInfo.txt"

#The data in this file is in order of the way the properties of the sensor are read in below. If the order of either of these are changed
#They would have to be changed in the same fashion or this file would stop reading in the sensor properites correctly. 

f = open(sensorInfoFile)

SENSOR_INFO = []

for i in range(NUM_SENSORS):
	SENSOR_INFO.append(Sensor(i+1))
	SENSOR_INFO[i].set_name(f.readline().rstrip())
	SENSOR_INFO[i].set_type(f.readline().rstrip())
	SENSOR_INFO[i].set_i2cAddress(f.readline().rstrip())
	SENSOR_INFO[i].set_pinNumber(f.readline().rstrip())
	SENSOR_INFO[i].set_numberOfAnalysis(f.readline().rstrip())
	SENSOR_INFO[i].set_voltage(f.readline().rstrip())
	SENSOR_INFO[i].set_mqttIP(f.readline().rstrip())
	SENSOR_INFO[i].set_mqttSensor(f.readline().rstrip())
	for x in range(3):
		SENSOR_INFO[i].set_analysis(f.readline().rstrip(), x)
		SENSOR_INFO[i].set_threshold(f.readline().rstrip(),f.readline().rstrip(), x)
		SENSOR_INFO[i].set_binType(f.readline().rstrip(), x)
		SENSOR_INFO[i].set_fromSensorNumber(f.readline().rstrip(), x)
		SENSOR_INFO[i].set_fromSensorMin(f.readline().rstrip(), x)
		SENSOR_INFO[i].set_fromSensorMax(f.readline().rstrip(), x)
		SENSOR_INFO[i].set_weekdays(f.readline().rstrip(),f.readline().rstrip(),f.readline().rstrip(),f.readline().rstrip(),f.readline().rstrip(),f.readline().rstrip(),f.readline().rstrip(), x)
		SENSOR_INFO[i].set_customStartStop(f.readline().rstrip(),f.readline().rstrip(), x)
		SENSOR_INFO[i].set_summaryMethod(f.readline().rstrip(), x)
	#if i >= 0 and i < 3:
	# 	print "Name: " + SENSOR_INFO[i].name
	# 	print "Type: " + SENSOR_INFO[i].type
	# 	print "i2c Address: " + SENSOR_INFO[i].i2cAddress
	# 	print "Pin Number: " + SENSOR_INFO[i].pinNumber
	#	print "Number Of Analysis: " + SENSOR_INFO[i].numberOfAnalysis
	#	print "Wattage: " + SENSOR_INFO[i].wattage
	# 	for k in range(3):
	# 		print "Analysis: " + SENSOR_INFO[i].analysis[k]
	# 		print "Bin Type: " + SENSOR_INFO[i].binType[k]
	# 		print "From Sensor Number: " + SENSOR_INFO[i].fromSensorNumber[k]
	# 		print "From Sensor Min: " + SENSOR_INFO[i].fromSensorMin[k]
	# 		print "From Sensor Max: " + SENSOR_INFO[i].fromSensorMax[k]
	#		print "Weekdays: " + SENSOR_INFO[i].weekdays[k][0] + " " + SENSOR_INFO[i].weekdays[k][1] + " " + SENSOR_INFO[i].weekdays[k][2] + " " + SENSOR_INFO[i].weekdays[k][3] + " " + SENSOR_INFO[i].weekdays[k][4] + " " + SENSOR_INFO[i].weekdays[k][5] + " " + SENSOR_INFO[i].weekdays[k][6]
	#		print "Custom Start/Stop: " + SENSOR_INFO[i].customStart[k] + " " + SENSOR_INFO[i].customStop[k]
	# 		print "Summary Method: " + SENSOR_INFO[i].summaryMethod[k]

f.close()
