# ********************************************************************** #
# CERF PI LUX CENSOR Analysis                                            #
#                                                                        #
# Analyziz readings from lux sensors for summary data                    #
#                                                                        #
# Started by Derek De Young                                              #
# Continued by Curtis Kortman						 #
# Started: 4/25/15                                                       #
# Last Edited: 6/16/15                                                   #
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
#------------------------Initialize Variables----------------------
#==================================================================

debug = False # used for helping in development of code, turn to false for normal operation

nameOfPi = str(PI_NUMBER) # From Global Vars 
month_list= ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"]
#Base directory leading to the summary
summary_path = '/home/pi/Desktop/Data/Pi_' + nameOfPi + '_Summary/'
#Base directory leading to the raw
raw_path = '/home/pi/Desktop/Data/Pi_' + nameOfPi + '_Raw/'
year = datetime.datetime.strftime(datetime.datetime.now(), '%Y')

# ***********************GLOABL VARIABLES************************ #
light_tol = SENSOR_TOL   # from global_vars
low_peak_time = PEAK_TIME1 # from global_vars
high_peak_time = PEAK_TIME2 # from global_vars

#==================================================================
#------------------------Function Definitions----------------------
#==================================================================


					#createDirectories() creates the folders used to organize the data for easier reference 
def createDirectories():
	if not os.path.exists(summary_path + 'bins/'):
		os.makedirs(summary_path + 'bins/')
	if not os.path.exists(summary_path + 'on/off-peak/'):
		os.makedirs(summary_path + 'on/off-peak/')
	if not os.path.exists(summary_path + 'min-max-ave/'):
		os.makedirs(summary_path + 'min-max-ave/')

#------------------------------------------------------------------

					#initializeSummary() writes the metadata to each file
def initializeSummary(sensor, sensorType):
	filename = (summary_path + str(sensorType) + '/Pi_' + nameOfPi + '_'+ sensor + '_' + year + '.csv')
	summaryfile = open(filename, 'w')
	summaryfile.write("#Calvin College CERF PI DATA"+ '\n')
	summaryfile.close()

#------------------------------------------------------------------
					
					#delclares the path to the data
def get_full_raw_path(sensor):
	return (raw_path + 'Sensor' + sensor + '/' + year + '/')

#------------------------------------------------------------------

					#extrapolateOnPeakOffPeakData() determines if the data was high during on peak, or high during off peak
def extrapolateOnPeakOffPeakData(month, sensor, sensorName):
	full_raw_path = get_full_raw_path(sensor)
	total_min_off_peak = 0
	total_min_on_peak = 0
	min_on_peak = 0
	min_off_peak = 0
	if not os.path.exists(full_raw_path + month):
		filestring = nameOfPi + ',' + sensor + ',' + sensorName + ',' + year + ',' + month + ',0.00,0.00\n'
	else:
		for file in os.listdir(full_raw_path + month):
			file = open(full_raw_path + month + '/' + file)
			for line in file:
				if line[0] != "#":
					row = re.split(',',line)
					time = row[4]
					data = row[5].replace('\n','')
					if 'e' in data:
						data = '0'
					hour = time[-8:-6]
					day = time[8:10]
					weekday = date(int(year),int(month),int(day)).weekday()
					peak_hour = int(hour) >= low_peak_time and int(hour) < high_peak_time
					peak_day = weekday < 5
					if (peak_hour and peak_day):
						if (float(data) > light_tol):
							total_min_on_peak += 1
							min_on_peak += 1
						else:
							total_min_on_peak += 1
					else:
						if (float(data) > light_tol):
							total_min_off_peak += 1
							min_off_peak += 1
						else:
							total_min_off_peak += 1
			file.close()
		print min_on_peak
		if total_min_on_peak != 0:
    			percentage_on_peak = (float(min_on_peak)/total_min_on_peak)*100
		else:
			percentage_on_peak = 0
		if total_min_off_peak != 0:
			percentage_off_peak = (float(min_off_peak)/total_min_off_peak)*100
		else:
			percentage_off_peak = 0
		filestring = (nameOfPi + ',' + sensor + ',' + sensorName + ',' + year + ',' + month + ',' + "%.2f" %percentage_on_peak +','+ "%.2f" %percentage_off_peak +'\n')
	return filestring

#------------------------------------------------------------------

def extrapolateMinMaxAveData(month, sensor, sensorName):
	full_raw_path = get_full_raw_path(sensor)
	maxTempDay = 0.0
	maxTempNight = 0.0
	minTempDay = 100.0
	minTempNight = 100.0
	minutesInRangeDay = 0
	minutesInRangeNight = 0
	dayMinutes = 0
	nightMinutes = 0
	total_min_off_peak = 0
	total_min_on_peak = 0
	min_on_peak = 0
	min_off_peak = 0
	if not os.path.exists(full_raw_path + month):
		filestring = (nameOfPi + ',' + sensor + ',' + sensorName + ',' + year + ',' + month + ',0.00,0.00,0.00,0.00,0.00,0.00\n')
	else:
		for file in os.listdir(full_raw_path + month):
			file = open(full_raw_path + month + '/' + file)
			for line in file:
				if line[0] != "#":
					row = re.split(',',line)
					time = row[4]
					data = row[5].replace('\n','')
					hour = time[-8:-6]
					day = time[8:10]
					weekday = date(int(year),int(month),int(day)).weekday()
					day = ((int(hour) > 8) and (int(hour) < 17))
					if (day and (float(data) > float(maxTempDay))):
						maxTempDay = data
					elif (day and (float(data) < float(minTempDay))):
						minTempDay = data
					elif ((not day) and (float(data) > float(maxTempNight))):
						maxTempNight = data
					elif ((not day) and (float(data) < float(minTempNight))):
						minTempNight = data
					if (day and (float(data) > 20) and (float(data) < 22)):
						minutesInRangeDay += 1
					elif ((not day) and (float(data) > 20) and (float(data) < 24)):
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
		filestring = (nameOfPi + ',' + sensor + ',' + sensorName + ',' + year + ',' + month + ',' + str(maxTempDay) + ',' + str(maxTempNight) + ',' + str(minTempDay) + ',' + str(minTempNight) + ',' + "%.2f" %percentageInRangeDay +','+ "%.2f" %percentageInRangeNight +'\n')
	return filestring

#------------------------------------------------------------------

					#AnalyzePeak() performas an on/off-peak analysis of the data
def AnalyzePeak(sensor, sensorName, sensorType):
    	initializeSummary(sensor, "on/off-peak")
	filename = (summary_path + 'on/off-peak/Pi_' + nameOfPi + '_'+ sensor + '_' + year + '.csv')
    	summaryfile = open(filename, 'a')
    	summaryfile.write("#Pi_Number,Sensor_Number," + str(SENSOR_NAMES[int(sensor)-1]) + ",Year,Month,On_Peak%,Off_Peak%" + '\n')
 
    	for month in month_list:
		filestring = extrapolateOnPeakOffPeakData(month, sensor, sensorName)
		summaryfile.write(filestring)
		print(filestring)		

#------------------------------------------------------------------

					#AnalyzeMinMaxAve() performs a min, max, and average analysis on the data
def AnalyzeMinMaxAve(sensor, sensorName, sensorType):
    	initializeSummary(sensor, "min-max-ave")
	filename = (summary_path + 'min-max-ave/Pi_' + nameOfPi + '_'+ sensor + '_' + year + '.csv')
    	summaryfile = open(filename, 'a')
    	summaryfile.write("#Pi_Number,Sensor_Number," + str(SENSOR_NAMES[int(sensor)-1]) + ",Year,Month,Max_Temp_Day, Max_Temp_Night, Min_Temp_Day, Min_Temp_Night, Time_in_Range_Day, Time_in_Range_Night" + '\n')

	for month in month_list:
		filestring = extrapolateMinMaxAveData(month, sensor, sensorName)
		summaryfile.write(filestring)
		print(filestring)		

#------------------------------------------------------------------

					#creates bins of start and stop times for certain data parameters	
def AnalyzeBins(sensor, sensorName, sensorType):
	initializeSummary(sensor, "bins")
	filename = (summary_path + 'bins/Pi_' + nameOfPi + '_'+ sensor + '_' + year + '.csv')
	summaryfile = open(filename, 'a')
	summaryfile.write("#Pi_Number,Sensor_Number," + str(SENSOR_NAMES[int(sensor)-1]) + ",Year,Month,Start_Time,End_Time" + '\n')
	full_raw_path = get_full_raw_path(sensor)

	inRangeBefore = False
	inRangeNow = False
	close = False
	time = ""
	fileList = []

	for month in month_list:
		if not os.path.exists(full_raw_path + month):
			a = 0
		else:
			for file in os.listdir(full_raw_path + month):
				fileList.append(file)
			fileList.sort()
			for file in fileList:
				file = open(full_raw_path + month + '/' + file)
				for line in file:
					if line[0] != "#":
						row = re.split(',',line)
						time = row[4]
						data = row[5].replace('\n','')
						hour = time[-8:-6]
						day = time[8:10]
						if ((float(data) > 50.0) and (float(data) < 120.0)):
							inRangeNow = True
						else:
							inRangeNow = False
						if ((inRangeNow == True) and (inRangeBefore == False)):
							summaryfile.write(nameOfPi + ',' + sensor + ',' + sensorName + ',' + year + ',' + month + ',' + time)
							print(nameOfPi + ',' + sensor + ',' + sensorName + ',' + year + ',' + month + ',' + time),
							close = False
						if ((inRangeNow == False) and (inRangeBefore == True)):
							summaryfile.write(',' + time + '\n')
							print(',' + time + '\n')
							close = True
						inRangeBefore = inRangeNow
	if close != True:
		summaryfile.write(',' + time + '\n')
		print(',' + time + '\n')

#------------------------------------------------------------------

					#analyzeData() calls the functions to output for each of the sensors
def analyzeData():      
	for i in range(TOTAL_SENSORS):
    		AnalyzePeak(str(i+1), SENSOR_NAMES[i], SENSOR_TYPES[i])
		AnalyzeMinMaxAve(str(i+1), SENSOR_NAMES[i], SENSOR_TYPES[i])
		AnalyzeBins(str(i+1), SENSOR_NAMES[i], SENSOR_TYPES[i])

#==================================================================
#-------------------------MAIN APPLICATION-------------------------
#==================================================================

createDirectories()
analyzeData()
#AnalyzeBins(str(1), SENSOR_NAMES[0], SENSOR_TYPES[0])




