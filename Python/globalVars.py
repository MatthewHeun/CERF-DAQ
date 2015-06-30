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
	SENSOR_INFO[i].set_peak(f.readline().rstrip(), f.readline().rstrip())
	SENSOR_INFO[i].set_threshold(f.readline().rstrip(), f.readline().rstrip())
	SENSOR_INFO[i].set_i2cAddress(f.readline().rstrip())
	SENSOR_INFO[i].set_pinNumber(f.readline().rstrip())

f.close()
