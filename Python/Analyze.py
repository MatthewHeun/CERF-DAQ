# ********************************************************************** #
# CERF PI LUX CENSOR Analysis                                            #
#                                                                        #
# Analyziz readings from lux sensors for summary data                    #
#                                                                        #
# Created by Derek De Young                                              #
# Started: 4/25/15                                                       #
# Last Edited: 6/12/15                                                   #
# ********************************************************************** #

# **************************IMPORTS************************************* #
import time
import datetime
import smbus
import re
import os
import re  #line delimiter
from datetime import date
from global_vars import*  # Global vars
#<<<<<<< HEAD
#==================================================================
#------------------------------DEFAULT LIST------------------------
#==================================================================
nameOfPi = str(PI_NUMBER) # From Global Vars 
month_list= ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"]
#Base directory leading to the summary
summary_path = '/home/pi/Desktop/Data/Pi_' + nameOfPi + '_Summary/'
#Base directory leading to the raw
raw_path = '/home/pi/Desktop/Data/Pi_' + nameOfPi + '_Raw/'
year = datetime.datetime.strftime(datetime.datetime.now(), '%Y')
print(year)
if not os.path.exists(summary_path + 'Light/'):
	os.makedirs(summary_path + 'Light/')
if not os.path.exists(summary_path + 'Temperature/'):
	os.makedirs(summary_path + 'Temperature/')
if not os.path.exists(summary_path + 'Occupancy/'):
	os.makedirs(summary_path + 'Occupancy/')
# **************************LIGHT ON TOLERANCE************************ #
light_tol = SENSOR_TOL   # from global_vars
low_peak_time = PEAK_TIME1 # from global_vars
high_peak_time = PEAK_TIME2 # from global_vars
# **************************INITIALIZE VARIABLES************************ #
debug = False # used for helping in development of code, turn to false for normal operation

# **********************FUNCTION DEFINITIONS***************************** #  

    
# analyzeData() calls the functions to output for each of the sensors
def analyzeData():      
	for i in range(TOTAL_SENSORS):
		if SENSOR_TYPES[i] == "Light":
    			AnalyzeLightSensor(str(i+1), SENSOR_NAMES[i])
		elif SENSOR_TYPES[i] == "Temperature":
			AnalyzeTemperatureSensor(str(i+1), SENSOR_NAMES[i])		 
  
def AnalyzeLightSensor(sensor, sensor_discrip):
    full_raw_path = (raw_path + 'Sensor' + sensor + '/' + year + '/')
    filename = (summary_path + '/Light/Pi_' + nameOfPi + '_'+ sensor + '_' + year + '.csv')
    summaryfile = open(filename, 'w')
    summaryfile.write("#Calvin College CERF PI DATA"+ '\n')
    summaryfile.close()
    summaryfile = open(filename, 'a')
    summaryfile.write("#Pi_Number,Sensor_Number,SENSOR_NAMES[sensor-1],Year,Month,On_Peak%,Off_Peak%" + '\n')

    if debug:
        print ('directory: ' + fullpath)
        print ('This directory exists' + str(os.path.exists(fullpath)))
 
    for month in month_list:
	#******initializing counters*****
    	total_min_off_peak = 0
    	total_min_on_peak = 0
    	min_on_peak = 0
    	min_off_peak = 0
	#*********************************
	if not os.path.exists(full_raw_path + month):
		summaryfile.write(nameOfPi + ',' + sensor + ',' + sensor_discrip + ',' + year + ',' + month + ',0.00,0.00\n')
	else:
		for file in os.listdir(full_raw_path + month):
			file = open(full_raw_path + month + '/' + file)
			count = 0
			for line in file:
				if line[0] != "#":
					row = re.split(',',line)
					time = row[4]
					light = row[5].replace('\n','')
					if 'e' in light:
						light = '0'
					hour = time[-8:-6]
					day = time[8:10]
					weekday = date(int(year),int(month),int(day)).weekday()
					#print(str(weekday))
					peak_hour = int(hour) >= low_peak_time and int(hour) < high_peak_time
					peak_day = weekday < 5
					#print(peak_day)
					if peak_hour and peak_day:
						if float(light) > light_tol:
							total_min_on_peak += 1
							min_on_peak += 1
						else:
							total_min_on_peak += 1
					else:
						if float(light) > light_tol:
							total_min_off_peak += 1
							min_off_peak += 1
						else:
							total_min_off_peak += 1
					#print (total_min_off_peak)	
					#print (min_off_peak)			
    			#print("Total on: " + str(total_min_on_peak))
			#print("Amount on: " + str(min_on_peak))
			#print("Total off: " + str(total_min_off_peak))
			#print("Amount off: " + str(min_off_peak))
			file.close()
		if total_min_on_peak != 0:
    			percentage_on_peak = (float(min_on_peak)/total_min_on_peak)*100
		else:
			percentage_on_peak = 0
		if total_min_off_peak != 0:
			percentage_off_peak = (float(min_off_peak)/total_min_off_peak)*100
		else:
			percentage_off_peak = 0
		summaryfile.write(nameOfPi + ',' + sensor + ',' + sensor_discrip + ',' + year + ',' + month + ',' + "%.2f" %percentage_on_peak +','+ "%.2f" %percentage_off_peak +'\n')
		print(nameOfPi + ',' + sensor + ',' + sensor_discrip + ',' + year + ',' + month + ',' + "%.2f" %percentage_on_peak +','+ "%.2f" %percentage_off_peak +'\n')		

def AnalyzeTemperatureSensor(sensor, sensor_discrip):
    full_raw_path = (raw_path + 'Sensor' + sensor + '/' + year + '/')
    filename = (summary_path + '/Temperature/Pi_' + nameOfPi + '_'+ sensor + '_' + year + '.csv')
    summaryfile = open(filename, 'w')
    summaryfile.write("#Calvin College CERF PI DATA"+ '\n')
    summaryfile.close()
    summaryfile = open(filename, 'a')
    summaryfile.write("#Pi_Number,Sensor_Number,SENSOR_NAMES[sensor-1],Year,Month,Max_Temp_Day, Max_Temp_Night, Min_Temp_Day, Min_Temp_Night, Time_in_Range_Day, Time_in_Range_Night" + '\n')

    if debug:
        print ('directory: ' + fullpath)
        print ('This directory exists' + str(os.path.exists(fullpath)))
 
    for month in month_list:
	#******initializing counters*****
    	maxTempDay = 0
	maxTempNight = 0
    	minTempDay = 100
	minTempNight = 100
    	minutesInRangeDay = 0
    	minutesInRangeNight = 0
	dayMinutes = 0
	nightMinutes = 0
	#*********************************
	if not os.path.exists(full_raw_path + month):
		summaryfile.write(nameOfPi + ',' + sensor + ',' + sensor_discrip + ',' + year + ',' + month + ',0.00,0.00,0.00,0.00,0.00,0.00\n')
	else:
		for file in os.listdir(full_raw_path + month):
			file = open(full_raw_path + month + '/' + file)
			count = 0
			for line in file:
				if line[0] != "#":
					row = re.split(',',line)
					time = row[4]
					temp = row[5].replace('\n','')
					hour = time[-8:-6]
					day = time[8:10]
					weekday = date(int(year),int(month),int(day)).weekday()
					day = ((int(hour) > 8) and (int(hour) < 17))
					if day and (float(temp) > maxTempDay):
						maxTempDay = temp
					elif day and (float(temp) < minTempDay):
						minTempDay = temp
					elif (not day) and (float(temp) > maxTempNight):
						maxTempNight = temp
					elif (not day) and (float(temp) < minTempNight):
						minTempNight = temp
					if (day and (float(temp) > 19) and (float(temp) < 25)):
						minutesInRangeDay += 1
					elif ((not day) and (float(temp) > 19) and (float(temp) < 25)):
						minutesInRangeNight += 1
					if day:
						dayMinutes += 1
					if not day:
						nightMinutes += 1				
			file.close()
		if minTempNight == 100:
			minTempNight = 0
		if minTempDay == 100:
			minTempDay = 0
		if minutesInRangeDay != 0:
    			percentageInRangeDay = (float(minutesInRangeDay)/dayMinutes)*100
		else:
			percentageInRangeDay = 0
		if minutesInRangeNight != 0:
    			percentageInRangeNight = (float(minutesInRangeNight)/nightMinutes)*100
		else:
			percentageInRangeNight = 0
		summaryfile.write(nameOfPi + ',' + sensor + ',' + sensor_discrip + ',' + year + ',' + month + ',' + str(maxTempDay) + ',' + str(maxTempNight) + ',' + str(minTempDay) + ',' + str(minTempNight) + ',' + "%.2f" %percentageInRangeDay +','+ "%.2f" %percentageInRangeNight +'\n')
		print(nameOfPi + ',' + sensor + ',' + sensor_discrip + ',' + year + ',' + month + ',' + str(maxTempDay) + ',' + str(maxTempNight) + ',' + str(minTempDay) + ',' + str(minTempNight) + ',' + "%.2f" %percentageInRangeDay +','+ "%.2f" %percentageInRangeNight +'\n')		


while(1):
    analyzeData()
    if not debug:
        break
    time.sleep(5)





