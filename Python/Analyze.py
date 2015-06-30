# ********************************************************************** #
# CERF PI LUX CENSOR Analysis                                            #
#                                                                        #
# Analyziz readings from lux sensors for summary data                    #
#                                                                        #
# Started by Derek De Young                                              #
# Continued by Curtis Kortman						 #
# Started: 4/25/15                                                       #
# Last Edited: 6/30/15                                                   #
# ********************************************************************** #

# **************************IMPORTS************************************* #
import time
import datetime
import smbus
import re
import os
import re  #line delimiter
from datetime import date
from globalVars import*  # Global vars
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


#==================================================================
#------------------------Function Definitions----------------------
#==================================================================
					#createDirectories() creates the folders used to organize the data for easier reference 
def createDirectories():
	if not os.path.exists(summary_path + 'Bins/'):
		os.makedirs(summary_path + 'Bins/')
	if not os.path.exists(summary_path + 'Peak/'):
		os.makedirs(summary_path + 'Peak/')
	if not os.path.exists(summary_path + 'Min-Max/'):
		os.makedirs(summary_path + 'Min-Max/')

#------------------------------------------------------------------

					#initializeSummary() writes the metadata to each file
def initializeSummary(sensor, analysis):
	filename = (summary_path + str(analysis) + '/Pi_' + nameOfPi + '_'+ str(sensor.number) + '_' + year + '.csv')
	summaryfile = open(filename, 'w')
	if summaryfile.closed:
		raise fileError("file not open")
		print "FILE IS CLOSED"
	summaryfile.write("#Calvin College CERF PI DATA"+ '\n')
	summaryfile.close()

#------------------------------------------------------------------
					
					#delclares the path to the data
def get_full_raw_path(sensor):
	return (raw_path + 'Sensor' + str(sensor.number) + '/' + year + '/')

#------------------------------------------------------------------

					#extrapolateOnPeakOffPeakData() determines if the data was high during on peak, or high during off peak
def extrapolateOnPeakOffPeakData(month, sensor):
	full_raw_path = get_full_raw_path(sensor)
	total_min_off_peak = 0
	total_min_on_peak = 0
	min_on_peak = 0
	min_off_peak = 0
	if not os.path.exists(full_raw_path + month):
		filestring = nameOfPi + ',' + str(sensor.number) + ',' + sensor.name + ',' + year + ',' + month + ',0.00,0.00\n'
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
					peak_hour = int(hour) >= sensor.peakStart and int(hour) < sensor.peakStop
					peak_day = weekday < 5
					if (peak_hour and peak_day):
						if (float(data) > sensor.thresholdMin):
							total_min_on_peak += 1
							min_on_peak += 1
						else:
							total_min_on_peak += 1
					else:
						if (float(data) > sensor.thresholdMin):
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
		filestring = (nameOfPi + ',' + str(sensor.number) + ',' + sensor.name + ',' + year + ',' + month + ',' + "%.2f" %percentage_on_peak +','+ "%.2f" %percentage_off_peak +'\n')
	return filestring

#------------------------------------------------------------------

def extrapolateMinMaxAveData(month, sensor):
	full_raw_path = get_full_raw_path(sensor)
	maxDay = 0.0
	maxNight = 0.0
	minDay = 100000.0
	minNight = 100000.0
	minutesInRangeDay = 0
	minutesInRangeNight = 0
	dayMinutes = 0
	nightMinutes = 0
	total_min_off_peak = 0
	total_min_on_peak = 0
	min_on_peak = 0
	min_off_peak = 0
	if not os.path.exists(full_raw_path + month):
		filestring = (nameOfPi + ',' + str(sensor.number) + ',' + sensor.name + ',' + year + ',' + month + ',0.00,0.00,0.00,0.00,0.00,0.00\n')
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
					day = ((int(hour) > int(sensor.peakStart)) and (int(hour) < int(sensor.peakStop)))
					if (day and (float(data) > float(maxDay))):
						maxDay = data
					elif (day and (float(data) < float(minDay))):
						minDay = data
					elif ((not day) and (float(data) > float(maxNight))):
						maxNight = data
					elif ((not day) and (float(data) < float(minNight))):
						minNight = data
					if (day and (float(data) > float(sensor.thresholdMin)) and (float(data) < float(sensor.thresholdMax))):
						minutesInRangeDay += 1
					elif ((not day) and (float(data) > float(sensor.thresholdMin)) and (float(data) < float(sensor.thresholdMax))):
						minutesInRangeNight += 1
					if day:
						dayMinutes += 1
					if not day:
						nightMinutes += 1				
			file.close()
		if minNight == 100000:
			minNight = 0
		if minDay == 100000:
			minDay = 0
		if minutesInRangeDay != 0:
    			percentageInRangeDay = (float(minutesInRangeDay)/dayMinutes)*100
		else:
			percentageInRangeDay = 0
		if minutesInRangeNight != 0:
    			percentageInRangeNight = (float(minutesInRangeNight)/nightMinutes)*100
		else:
			percentageInRangeNight = 0
		filestring = (nameOfPi + ',' + str(sensor.number) + ',' + sensor.name + ',' + year + ',' + month + ',' + str(maxDay) + ',' + str(maxNight) + ',' + str(minDay) + ',' + str(minNight) + ',' + "%.2f" %percentageInRangeDay +','+ "%.2f" %percentageInRangeNight +'\n')
	return filestring

#------------------------------------------------------------------

					#AnalyzePeak() performas an on/off-peak analysis of the data
def AnalyzePeak(sensor):
    	initializeSummary(sensor, "Peak")
	filename = (summary_path + 'Peak/Pi_' + nameOfPi + '_'+ str(sensor.number) + '_' + year + '.csv')
    	summaryfile = open(filename, 'a')
	if summaryfile.closed:
		raise fileError("file not open")
		print "FILE IS CLOSED"
    	summaryfile.write("#Pi_Number,Sensor_Number," + str(sensor.name) + ",Year,Month,On_Peak%,Off_Peak%" + '\n')
 
    	for month in month_list:
		filestring = extrapolateOnPeakOffPeakData(month, sensor)
		summaryfile.write(filestring)	

	summaryfile.close()	

#------------------------------------------------------------------

					#AnalyzeMinMaxAve() performs a min, max, and average analysis on the data
def AnalyzeMinMaxAve(sensor):
    	initializeSummary(sensor, "Min-Max")
	filename = (summary_path + 'Min-Max/Pi_' + nameOfPi + '_'+ str(sensor.number) + '_' + year + '.csv')
    	summaryfile = open(filename, 'a')
	if summaryfile.closed:
		raise fileError("file not open")
		print "FILE IS CLOSED"
    	summaryfile.write("#Pi_Number,Sensor_Number," + str(sensor.name) + ",Year,Month,Max_Day, Max_Night, Min_Day, Min_Night, Time_in_Range_Day, Time_in_Range_Night" + '\n')

	for month in month_list:
		filestring = extrapolateMinMaxAveData(month, sensor)
		summaryfile.write(filestring)
		print(filestring)
	
	summaryfile.close()		

#------------------------------------------------------------------

					#creates bins of start and stop times for certain data parameters	
def AnalyzeBins(sensor):
	initializeSummary(sensor, "Bins")
	filename = (summary_path + 'Bins/Pi_' + nameOfPi + '_'+ str(sensor.number) + '_' + year + '.csv')
	summaryfile = open(filename, 'a')
	if summaryfile.closed:
		raise fileError("file not open")
		print "FILE IS CLOSED"
	summaryfile.write("#Pi_Number,Sensor_Number," + str(sensor.name) + ",Year,Month,Start_Time,End_Time" + '\n')
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
						if ((float(data) > float(sensor.thresholdMin)) and (float(data) < float(sensor.thresholdMax))):
							inRangeNow = True
						else:
							inRangeNow = False
						if ((inRangeNow == True) and (inRangeBefore == False)):
							summaryfile.write(nameOfPi + ',' + str(sensor.number) + ',' + sensor.name + ',' + year + ',' + month + ',' + time)
							print(nameOfPi + ',' + str(sensor.number) + ',' + sensor.name + ',' + year + ',' + month + ',' + time),
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
	for i in range(NUM_SENSORS):
    		AnalyzePeak(SENSOR_INFO[i])
		AnalyzeMinMaxAve(SENSOR_INFO[i])
		AnalyzeBins(SENSOR_INFO[i])

#==================================================================
#-------------------------MAIN APPLICATION-------------------------
#==================================================================

createDirectories()
analyzeData()

#AnalyzeBins(str(1), SENSOR_NAMES[0], SENSOR_TYPES[0])




