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
	SENSOR_INFO[i].set_i2cAddress(f.readline().rstrip())
	SENSOR_INFO[i].set_pinNumber(f.readline().rstrip())
	SENSOR_INFO[i].set_numberOfAnalysis(f.readline().rstrip())

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
	# if i > 1 and i < 3:
	# 	print "Name: " + SENSOR_INFO[i].name
	# 	print "Type: " + SENSOR_INFO[i].type
	# 	print "i2c Address: " + SENSOR_INFO[i].i2cAddress
	# 	print "Pin Number: " + SENSOR_INFO[i].pinNumber
	#	print "Number Of Analysis: " + SENSOR_INFO[i].numberOfAnalysis
	# 	for k in range(3):
	# 		print "Analysis: " + SENSOR_INFO[i].analysis[k]
	# 		print "Bin Type: " + SENSOR_INFO[i].binType[k]
	# 		print "From Sensor Number: " + SENSOR_INFO[i].fromSensorNumber[k]
	# 		print "From Sensor Min: " + SENSOR_INFO[i].fromSensorMin[k]
	# 		print "From Sensor Max: " + SENSOR_INFO[i].fromSensorMax[k]
	# 		print "Weekdays: " + SENSOR_INFO[i].weekdays[k][0] + " " + SENSOR_INFO[i].weekdays[k][1] + " " + SENSOR_INFO[i].weekdays[k][2] + " " + SENSOR_INFO[i].weekdays[k][3] + " " + SENSOR_INFO[i].weekdays[k][4] + " " + SENSOR_INFO[i].weekdays[k][5] + " " + SENSOR_INFO[i].weekdays[k][6]
	# 		print "Custom Start/Stop: " + SENSOR_INFO[i].customStart[k] + " " + SENSOR_INFO[i].customStop[k]
	# 		print "Summary Method: " + SENSOR_INFO[i].summaryMethod[k]

f.close()
