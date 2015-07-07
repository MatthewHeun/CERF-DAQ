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
import calendar
import datetime
import smbus
import re
import os
import re  #line delimiter
from datetime import date
from globalVars import*  # Global vars
#<<<<<<< HEAD

#==================================================================
#-------------------Tell the website the pi is busy----------------
#==================================================================

file = open('/home/cjk36/Desktop/CERF-DAQ/WebPage/pages/analysisStatus.txt', "w")
file.write("1")
file.close()

#==================================================================
#------------------------Initialize Variables----------------------
#==================================================================

debug = False # used for helping in development of code, turn to false for normal operation

nameOfPi = str(PI_NUMBER) # From Global Vars 
month_list= ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"]
#Base directory leading to the summary
summary_path = '/home/cjk36/Desktop/Data/Pi_' + nameOfPi + '_Summary/'
#Base directory leading to the raw
raw_path = '/home/cjk36/Desktop/Data/Pi_' + nameOfPi + '_Raw/'
year = datetime.datetime.strftime(datetime.datetime.now(), '%Y')



#==================================================================
#------------------------Function Definitions----------------------
#==================================================================
					#createDirectories() creates the folders used to organize the data for easier reference 
def createDirectories():
	if not os.path.exists(summary_path + 'Bins/'):
		os.makedirs(summary_path + 'Bins/')
	if not os.path.exists(summary_path + 'Analysis/'):
		os.makedirs(summary_path + 'Analysis/')

#------------------------------------------------------------------

					#initializeSummary() writes the metadata to each file
def initializeFile(sensor, folder):
	filename = (summary_path + folder + '/Pi_' + nameOfPi + '_'+ str(sensor.number) + '_' + year + '.csv')
	newfile = open(filename, 'w')
	newfile.write("#Calvin College CERF PI DATA"+ '\n')
	newfile.close()
	return filename

#------------------------------------------------------------------
					
					#delclares the path to the data
def get_full_raw_path(sensor):
	return (raw_path + 'Sensor' + str(sensor.number) + '/' + year + '/')

#------------------------------------------------------------------
					
					#adds one to the month of a datetime object
def addMonth(originalDate):
	month = originalDate.month 
	year = originalDate.year + month / 12 								# if it is december, integer division will cause month / 12 to be 1 and the year to therefore increment
	month = month % 12 + 1 												# now increment the month
	day = min(originalDate.day, calendar.monthrange(year, month)[1])
	return datetime.datetime(year, month, day)

#------------------------------------------------------------------
					
					#finds the difference in months between two dates
def monthsDiff(date1, date2):
	return ((date1.year - date2.year)*12 + date1.month - date2.month)

#------------------------------------------------------------------
					
					#finds the earliest month for a sensor's data collection
def getFirstYear(sensor):
	years = []
	for name in os.listdir(raw_path + 'Sensor' + str(sensor.number) + '/'):
		years.append(name)
	return min(years)

#------------------------------------------------------------------
					
					#finds the earliest month for a sensor's data collection
def getFirstMonth(sensor, year):
	months = []
	for name in os.listdir(raw_path + 'Sensor' + str(sensor.number) + '/' + year + '/'):
		months.append(name)
	return min(months)

#------------------------------------------------------------------
					
					#finds the earliest day for a sensor's data collection
def getFirstDay(sensor, year, month):
	days = []
	for name in os.listdir(raw_path + 'Sensor' + str(sensor.number) + '/' + year + '/' + month + '/'):
		days.append(name)
	days = ((min(days).split('-')[2]).split('.')[0])
	return days

#------------------------------------------------------------------
					
					#finds the earliest dare of a sensor's data collection
def getFirstDate(sensor):
	firstYear = getFirstYear(sensor)
	firstMonth = getFirstMonth(sensor, firstYear)
	firstDay = getFirstDay(sensor, firstYear, firstMonth)
	return datetime.datetime.strptime("firstYear + ' ' + firstMonth + ' ' + firstDay", "%Y %m %d")

#------------------------------------------------------------------
					
					#creates a list of start and stop times divided by years
def createYearBins(sensor):
	filename = initializeFile(sensor, "Bins")
	binFile = open(filename, 'a')
	binFile.write("#Pi_Number,Sensor_Number," + str(sensor.name) + ",Start_Time,End_Time" + '\n')

	firstYear = int(getFirstYear(sensor))
	today = datetime.datetime.today()
	endYear = int(today.year)

	startHour = datetime.datetime.strptime("00 00", "%H %M").time()
	endHour = datetime.datetime.strptime("23 59 59", "%H %M %S").time()

	for x in range(endYear-firstYear+1):
		filestring = (nameOfPi + ',' + str(sensor.number) + ',' + sensor.name + ',' + str(firstYear) + '-' + "01" + '-' + "01" + ' ' + str(startHour))
		filestring += (',' + str(firstYear) + '-' + "12" + '-' + str(calendar.monthrange(int(firstYear), 12)[1])+ ' ' + str(endHour) + '\n')
		binFile.write(filestring)
		firstYear += 1
		print filestring

#------------------------------------------------------------------

					#creates a list of start and stop times divided by months
def createMonthBins(sensor):
	filename = initializeFile(sensor, "Bins")
	binFile = open(filename, 'a')
	binFile.write("#Pi_Number,Sensor_Number," + str(sensor.name) + ",Start_Time,End_Time" + '\n')

	firstDate = getFirstDate(sensor)
	today = datetime.datetime.today()

	startHour = datetime.datetime.strptime("00 00", "%H %M").time()
	endHour = datetime.datetime.strptime("23 59 59", "%H %M %S").time()

	for x in range(monthsDiff(today, firstDate)+1):
		filestring = (nameOfPi + ',' + str(sensor.number) + ',' + sensor.name + ',' + str(firstDate.year) + '-' + str(firstDate.month) + '-' + "01" + ' ' + str(startHour))
		filestring += (',' + str(firstDate.year) + '-' + str(firstDate.month) + '-' + str((calendar.monthrange(int(firstDate.year), int(firstDate.month)))[1]) + ' ' + str(endHour) + '\n')
		binFile.write(filestring)
		firstDate = addMonth(firstDate)
		print filestring

	binFile.close()

#------------------------------------------------------------------
					
					#creates a list of start and stop times divided by months
def createDayBins(sensor):
	filename = initializeFile(sensor, "Bins")
	binFile = open(filename, 'a')
	binFile.write("#Pi_Number,Sensor_Number," + str(sensor.name) + ",Start_Time,End_Time" + '\n')

	firstDate = getFirstDate(sensor)
	today = datetime.datetime.today()

	startHour = datetime.datetime.strptime("00 00", "%H %M").time()
	endHour = datetime.datetime.strptime("23 59 59", "%H %M %S").time()

	for x in range(int((today-firstDate).days)):
		filestring = (nameOfPi + ',' + str(sensor.number) + ',' + sensor.name + ',' + str(firstDate.year) + '-' + str(firstDate.month) + '-' + str(firstDate.day) + ' ' + str(startHour))
		filestring += (',' + str(firstDate.year) + '-' + str(firstDate.month) + '-' + str(firstDate.day) + ' ' + str(endHour) + '\n')
		binFile.write(filestring)
		firstDate += datetime.timedelta(days=1)
		print filestring

	binFile.close()

#------------------------------------------------------------------
					
					#creates a list of start and stop times based on the data of a sensor
def createCustomBins(sensor):
	filename = initializeFile(sensor, "Bins")
	binFile = open(filename, 'a')
	binFile.write("#Pi_Number,Sensor_Number," + str(sensor.name) + ",Start_Time,End_Time" + '\n')

	firstDate = getFirstDate(sensor)
	today = datetime.datetime.today()
	startHour = int(sensor.customStart)
	endHour = int(sensor.customStop)

	if startHour < 10:
		startHour = '0' + str(startHour)
	if endHour <10:
		endHour = '0' + str(endHour)

	startHour = datetime.datetime.strptime(str(startHour), "%H").time()
	endHour = datetime.datetime.strptime(str(endHour), "%H").time()

	for x in range(int((today-firstDate).days)):
		filestring = (nameOfPi + ',' + str(sensor.number) + ',' + sensor.name + ',' + str(firstDate.year) + '-' + str(firstDate.month) + '-' + str(firstDate.day) + ' ' + str(startHour))
		filestring += (',' + str(firstDate.year) + '-' + str(firstDate.month) + '-' + str(firstDate.day) + ' ' + str(endHour) + '\n')
		binFile.write(filestring)
		firstDate += datetime.timedelta(days=1)
		print filestring

	binFile.close()

#------------------------------------------------------------------
					#creates a list of start and stop times based on the data of a sensor

def createSensorBins(sensor):
	filename = initializeFile(sensor, "Bins")
	binFile = open(filename, 'a')
	binFile.write("#Pi_Number,Sensor_Number," + str(sensor.name) + ",Year,Month,Start_Time,End_Time" + '\n')
	full_raw_path = get_full_raw_path(sensor)

	inRangeBefore = False
	inRangeNow = False
	close = False
	time = ""
	for month in month_list:
		fileList = []
		if os.path.exists(full_raw_path + month):
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
						if ((float(data) > float(sensor.fromSensorMin)) and (float(data) < float(sensor.fromSensorMax))):
							inRangeNow = True
						else:
							inRangeNow = False
						if ((inRangeNow == True) and (inRangeBefore == False)):
							binFile.write(nameOfPi + ',' + str(sensor.number) + ',' + sensor.name + ',' + year + ',' + month + ',' + time)
							print(nameOfPi + ',' + str(sensor.number) + ',' + sensor.name + ',' + year + ',' + month + ',' + time),
							close = False
						if ((inRangeNow == False) and (inRangeBefore == True)):
							binFile.write(',' + time + '\n')
							print(',' + time + '\n')
							close = True
						inRangeBefore = inRangeNow
	if close != True:
		binFile.write(',' + time + '\n')
		print(',' + time + '\n')

	binFile.close()

#------------------------------------------------------------------
					#creates a list of start and stop times based on configuration data

def createBins(sensor):
	if sensor.binType == "From Sensor":
		createSensorBins(sensor)
	elif sensor.binType == "Day":
		createDayBins(sensor)
	elif sensor.binType == "Month":
		createMonthBins(sensor)
	elif sensor.binType == "Custom Time":
		createCustomBins(sensor)
	elif sensor.binType == "Year":
		createYearBins(sensor)
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
					peak_hour = int(hour) >= int(sensor.peakStart) and int(hour) < int(sensor.peakStop)
					peak_day = weekday < 5
					if (peak_hour and peak_day):
						if (float(data) > float(sensor.thresholdMin)):
							total_min_on_peak += 1
							min_on_peak += 1
						else:
							total_min_on_peak += 1
					else:
						if (float(data) > float(sensor.thresholdMin)):
							total_min_off_peak += 1
							min_off_peak += 1
						else:
							total_min_off_peak += 1
			file.close()
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
    	summaryfile.write("#Pi_Number,Sensor_Number," + str(sensor.name) + ",Year,Month,Max_Day, Max_Night, Min_Day, Min_Night, Time_in_Range_Day, Time_in_Range_Night" + '\n')

	for month in month_list:
		filestring = extrapolateMinMaxAveData(month, sensor)
		summaryfile.write(filestring)
		print(filestring)
	
	summaryfile.close()		

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

createBins(SENSOR_INFO[0])

#==================================================================
#-----------------Tell the website the pi is not busy--------------
#==================================================================

file = open('/home/cjk36/Desktop/CERF-DAQ/WebPage/pages/analysisStatus.txt', "w")
file.write("0")
file.close()




