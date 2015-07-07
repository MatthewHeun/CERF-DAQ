from sensorClass import *

numPiFile = "/home/cjk36/Desktop/CERF-DAQ/WebPage/pages/piNumber.txt"

f = open(numPiFile)

PI_NUMBER = int(f.readline())

f.close()

numSensorFile = "/home/cjk36/Desktop/CERF-DAQ/WebPage/pages/numSensors.txt"

f = open(numSensorFile)

NUM_SENSORS = int(f.readline())

f.close()

sensorInfoFile = "/home/cjk36/Desktop/CERF-DAQ/WebPage/pages/sensorInfo.txt"

f = open(sensorInfoFile)

SENSOR_INFO = []

for i in range(NUM_SENSORS):
	SENSOR_INFO.append(Sensor(i+1))
	SENSOR_INFO[i].set_name(f.readline().rstrip())
	SENSOR_INFO[i].set_type(f.readline().rstrip())
	SENSOR_INFO[i].set_analysis(f.readline().rstrip())
	SENSOR_INFO[i].set_i2cAddress(f.readline().rstrip())
	SENSOR_INFO[i].set_pinNumber(f.readline().rstrip())
	SENSOR_INFO[i].set_binType(f.readline().rstrip())
	SENSOR_INFO[i].set_fromSensorNumber(f.readline().rstrip())
	SENSOR_INFO[i].set_fromSensorMin(f.readline().rstrip())
	SENSOR_INFO[i].set_fromSensorMax(f.readline().rstrip())
	SENSOR_INFO[i].set_weekdays(f.readline().rstrip(),f.readline().rstrip(),f.readline().rstrip(),f.readline().rstrip(),f.readline().rstrip(),f.readline().rstrip(),f.readline().rstrip())
	SENSOR_INFO[i].set_customStartStop(f.readline().rstrip(),f.readline().rstrip())
	SENSOR_INFO[i].set_summaryMethod(f.readline().rstrip())
	# if i < 2:
	# 	print "Name: " + SENSOR_INFO[i].name
	# 	print "Type: " + SENSOR_INFO[i].type
	# 	print "Analysis: " + SENSOR_INFO[i].analysis
	# 	print "i2c Address: " + SENSOR_INFO[i].i2cAddress
	# 	print "Pin Number: " + SENSOR_INFO[i].pinNumber
	# 	print "Bin Type: " + SENSOR_INFO[i].binType
	# 	print "From Sensor Number: " + SENSOR_INFO[i].fromSensorNumber
	# 	print "From Sensor Min: " + SENSOR_INFO[i].fromSensorMin
	# 	print "From Sensor Max: " + SENSOR_INFO[i].fromSensorMax
	# 	print "Weekdays: " + SENSOR_INFO[i].weekdays[0] + " " + SENSOR_INFO[i].weekdays[1] + " " + SENSOR_INFO[i].weekdays[2] + " " + SENSOR_INFO[i].weekdays[3] + " " + SENSOR_INFO[i].weekdays[4] + " " + SENSOR_INFO[i].weekdays[5] + " " + SENSOR_INFO[i].weekdays[6] + "." 
	# 	print "Custom Start/Stop: " + SENSOR_INFO[i].customStart + " " + SENSOR_INFO[i].customStop
	# 	print "Summary Method: " + SENSOR_INFO[i].summaryMethod

f.close()
