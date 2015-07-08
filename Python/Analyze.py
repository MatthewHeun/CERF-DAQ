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
from binClass import*
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
def initializeSummary(sensor):
	filename = (summary_path + 'Pi_' + nameOfPi + '_'+ str(sensor.number) + '_' + year + '.csv')
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
					
					#returns the date in a datetime format from a filename
def getDateFromFile(filename):
	datestring = ((filename.split('_')[3]).split('.')[0])
	return datetime.datetime.strptime(datestring, '%Y-%m-%d')

#------------------------------------------------------------------
					
					#returns the date in a datetime format from a datestring
def getDateFromDataString(datastring):
	return datetime.datetime.strptime(datastring, '%Y-%m-%d %H:%M:%S')

#------------------------------------------------------------------
					
					#returns true if the check date is within date1 and date2 (date 2 should be later than date 1)
def dateInRange(checkDate, date1, date2):
	if ((checkDate > date1) and (checkDate < date2)):
		return True
	else:
		return False

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
	return datetime.datetime.strptime(firstYear + ' ' + firstMonth + ' ' + firstDay, "%Y %m %d")

#------------------------------------------------------------------
					
					#creates a list of start and stop times divided by years
def createYearBins(sensor):
	firstYear = int(getFirstYear(sensor))
	today = datetime.datetime.today()
	endYear = int(today.year)

	startHour = datetime.datetime.strptime("00 00", "%H %M").time()
	endHour = datetime.datetime.strptime("23 59 59", "%H %M %S").time()

	for x in range(endYear-firstYear+1):
		startTime = (str(firstYear) + '-' + "01" + '-' + "01" + ' ' + str(startHour))
		stopTime = (str(firstYear) + '-' + "12" + '-' + str(calendar.monthrange(int(firstYear), 12)[1])+ ' ' + str(endHour))
		binArray[sensor.number-1].addBin(startTime, stopTime)
		firstYear += 1

#------------------------------------------------------------------

					#creates a list of start and stop times divided by months
def createMonthBins(sensor):
	firstDate = getFirstDate(sensor)
	today = datetime.datetime.today()

	startHour = datetime.datetime.strptime("00 00", "%H %M").time()
	endHour = datetime.datetime.strptime("23 59 59", "%H %M %S").time()

	for x in range(monthsDiff(today, firstDate)+1):
		startTime = (str(firstDate.year) + '-' + str(firstDate.month) + '-' + "01" + ' ' + str(startHour))
		stopTime = (str(firstDate.year) + '-' + str(firstDate.month) + '-' + str((calendar.monthrange(int(firstDate.year), int(firstDate.month)))[1]) + ' ' + str(endHour))
		binArray[sensor.number-1].addBin(startTime, stopTime)
		firstDate = addMonth(firstDate)

#------------------------------------------------------------------
					
					#creates a list of start and stop times divided by months
def createDayBins(sensor):
	firstDate = getFirstDate(sensor)
	today = datetime.datetime.today()

	startHour = datetime.datetime.strptime("00 00", "%H %M").time()
	endHour = datetime.datetime.strptime("23 59 59", "%H %M %S").time()

	for x in range(int((today-firstDate).days)):
		startTime = (str(firstDate.year) + '-' + str(firstDate.month) + '-' + str(firstDate.day) + ' ' + str(startHour))
		stopTime = (str(firstDate.year) + '-' + str(firstDate.month) + '-' + str(firstDate.day) + ' ' + str(endHour))
		binArray[sensor.number-1].addBin(startTime, stopTime)
		firstDate += datetime.timedelta(days=1)

#------------------------------------------------------------------
					
					#creates a list of start and stop times based on the data of a sensor
def createCustomBins(sensor):

	firstDate = getFirstDate(sensor)
	today = datetime.datetime.today()
	startHour = int(sensor.customStart)
	endHour = int(sensor.customStop)

	if startHour < 10:
		startHour = '0' + str(startHour)
	if endHour < 10:
		endHour = '0' + str(endHour)

	startHour = datetime.datetime.strptime(str(startHour), "%H").time()
	endHour = datetime.datetime.strptime(str(endHour), "%H").time()

	for x in range(int((today-firstDate).days)):
		startTime = (str(firstDate.year) + '-' + str(firstDate.month) + '-' + str(firstDate.day) + ' ' + str(startHour))
		stopTime = (str(firstDate.year) + '-' + str(firstDate.month) + '-' + str(firstDate.day) + ' ' + str(endHour))
		for day in sensor.weekdays:
			if str(day) == str(firstDate.weekday()):
				binArray[sensor.number-1].addBin(startTime, stopTime)
		firstDate += datetime.timedelta(days=1)

#------------------------------------------------------------------
					#creates a list of start and stop times based on the data of a sensor

def createSensorBins(sensor):
	firstYear = int(getFirstYear(sensor))
	today = datetime.datetime.today()
	endYear = int(today.year)

	inRangeBefore = False
	inRangeNow = False
	end = False
	time = ""
	startTime = ""
	endTime = ""
	oldTime = ""

	yearList = []
	for x in range(endYear - firstYear + 1):
		yearList.append(str(firstYear))
		firstYear += 1

	for year in yearList:
		for month in month_list:
			filepath = raw_path + 'Sensor' + str(sensor.number) + '/' + year + '/' + month
			fileList = []
			if os.path.exists(filepath):
				for file in os.listdir(filepath):
					fileList.append(file)
				fileList.sort()
				for file in fileList:
					file = open(filepath + '/' + file)
					for line in file:
						if line[0] != "#":
							row = re.split(',',line)
							time = row[4]
							data = row[5].replace('\n','')
							if ((float(data) > float(sensor.fromSensorMin)) and (float(data) < float(sensor.fromSensorMax))):
								inRangeNow = True
							else:
								inRangeNow = False
							if ((inRangeNow == True) and (inRangeBefore == False)):
								if str(oldTime) == "":
									binArray[sensor.number-1].addStartTime(time)
								else:
									binArray[sensor.number-1].addStartTime(oldTime)
								end = False
							if ((inRangeNow == False) and (inRangeBefore == True)):
								if str(oldTime) == "":
									binArray[sensor.number-1].addStopTime(time)
								else:
									binArray[sensor.number-1].addStopTime(oldTime)
								end = True
							inRangeBefore = inRangeNow
							oldTime = time
		if end != True:
			binArray[sensor.number-1].addstopTime(time)

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
def onPeakOffPeakAnalysis(sensor):
	initializeSummary(sensor)
	filename = (summary_path + 'Pi_' + nameOfPi + '_'+ str(sensor.number) + '_' + year + '.csv')
	summaryfile = open(filename, 'a')
	summaryString = "#Pi_Number,Sensor_Number," + str(sensor.name) + ",Start Time,End Time,On%,In/Out of Range" + '\n'
	summaryfile.write(summaryString)

	firstDate = getFirstDate(sensor)
	today = datetime.datetime.today()

	minutesOn = 0
	minutesOff = 0
	totalMinutes = 0
	binIndex = 0

	inRangeBefore = False
	inRangeNow = False
	end = False
	firstTimeThrough = True

	startYear = int(firstDate.year)
	startMonth = int(firstDate.month)

	for x in range(monthsDiff(today, firstDate)+1):
		if int(startMonth) < 10:
			startMonth = "0" + str(startMonth)

		filePath = raw_path + 'Sensor' + str(sensor.number) + '/' + str(startYear) + '/' + str(startMonth) + '/'

		if os.path.exists(filePath):
			for file in os.listdir(filePath):
				fileDate = getDateFromFile(file)
				file = open(filePath + file)
				for line in file:
					if line[0] != '#':
						row = re.split(',',line)
						time = row[4]
						data = row[5].replace('\n','')
						time = getDateFromDataString(time)
						if firstTimeThrough:
							lastTime = time;
						if dateInRange(time, binArray[sensor.number-1].timeArray[binIndex][0], binArray[sensor.number-1].timeArray[binIndex][1]):
							inRangeNow = True
						else:	
							inRangeNow = False
						
						if (float(data) > float(sensor.thresholdMin)):
							minutesOn += 1
							totalMinutes += 1
						else:
							minutesOff += 1
							totalMinutes += 1

						if ((inRangeNow == True) and (False == inRangeBefore) and (not firstTimeThrough)):
							percentOn = (float(minutesOn) / float(totalMinutes))
							summaryString = str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastTime) + ',' + str(time) + ',' + "%.2f" %percentOn + ",Not in Range" + '\n'
							summaryfile.write(summaryString)
							minutesOn = 0
							minutesOff = 0
							totalMinutes = 0
							lastTime = time

						if ((inRangeNow == False) and (True == inRangeBefore)):
							percentOn = (float(minutesOn) / float(totalMinutes))
							summaryString = str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastTime) + ',' + str(time) + ',' + "%.2f" %percentOn + ",In Range" + '\n'
							summaryfile.write(summaryString)
							binIndex += 1
							minutesOn = 0
							minutesOff = 0
							totalMinutes = 0
							lastTime = time

						inRangeBefore = inRangeNow
						firstTimeThrough = False

		startMonth  = int(startMonth) + 1
		if startMonth > 12:
			startMonth = 1
			startYear += 1

	if not end:
		inRangeString = ""
		if inRangeNow:
			inRangeString = "In Range"
		else:
			inRangeString = "Out of Range"
		percentOn = (float(minutesOn) / float(totalMinutes))
		summaryString = str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastTime) + ',' + str(time) + ',' + "%.2f" %percentOn + ',' + inRangeString + '\n'
		summaryfile.write(summaryString)
#------------------------------------------------------------------

						#determines the min and max the user defined in range, and out of range hours
def minMaxAnalysis(sensor):
	initializeSummary(sensor)
	filename = (summary_path + 'Pi_' + nameOfPi + '_'+ str(sensor.number) + '_' + year + '.csv')
	summaryfile = open(filename, 'a')
	summaryString = "#Pi_Number,Sensor_Number," + str(sensor.name) + ",Start Time,End Time,Max,Min,Ave,In/Out of Range" + '\n'
	summaryfile.write(summaryString)

	firstDate = getFirstDate(sensor)
	today = datetime.datetime.today()

	maximum = 0.0
	minimum = 100000.0
	average = 0.0
	totalMinutes = 0
	binIndex = 0
	
	inRangeBefore = False
	inRangeNow = False
	end = False
	firstTimeThrough = True

	startYear = int(firstDate.year)
	startMonth = int(firstDate.month)

	for x in range(monthsDiff(today, firstDate)+1):
		if int(startMonth) < 10:
			startMonth = "0" + str(startMonth)

		filePath = raw_path + 'Sensor' + str(sensor.number) + '/' + str(startYear) + '/' + str(startMonth) + '/'

		if os.path.exists(filePath):
			for file in os.listdir(filePath):
				fileDate = getDateFromFile(file)
				file = open(filePath + file)
				for line in file:
					if line[0] != '#':
						row = re.split(',',line)
						time = row[4]
						data = row[5].replace('\n','')
						time = getDateFromDataString(time)
						if firstTimeThrough:
							lastTime = time;
						if dateInRange(time, binArray[sensor.number-1].timeArray[binIndex][0], binArray[sensor.number-1].timeArray[binIndex][1]):
							inRangeNow = True
						else:	
							inRangeNow = False
						
						if (float(data) > float(maximum)):
							maximum = float(data)
						if (float(data) < float(minimum)):
							minimum = float(data)

						average += float(data)
						totalMinutes += 1

						if ((inRangeNow == True) and (False == inRangeBefore) and (not firstTimeThrough)):
							average = (float(average) / float(totalMinutes))
							summaryString = str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastTime) + ',' + str(time) + ',' + "%.2f" %maximum + ',' + "%2f" %minimum + ',' + "%2f" %average + ",Out of Range" + '\n'
							summaryfile.write(summaryString)
							maximum = 0.0
							minimum = 100000.0
							average = 0.0
							totalMinutes = 0.0
							lastTime = time
							end = True

						if ((inRangeNow == False) and (True == inRangeBefore)):
							average = float((float(average) / float(totalMinutes)))
							summaryString = str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastTime) + ',' + str(time) + ',' + "%.2f" %maximum + ',' + "%2f" %minimum + ',' + "%2f" %average + ",In Range" + '\n'
							summaryfile.write(summaryString)
							binIndex += 1
							maximum = 0.0
							minimum = 100000.0
							average = 0.0
							totalMinutes = 0.0
							lastTime = time
							end = True

						inRangeBefore = inRangeNow
						firstTimeThrough = False

		startMonth  = int(startMonth) + 1
		if startMonth > 12:
			startMonth = 1
			startYear += 1	
	if not end:
		inRangeString = ""
		if inRangeNow:
			inRangeString = "In Range"
		else:
			inRangeString = "Out of Range"
		average = float((float(average) / float(totalMinutes)))
		summaryString = str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastTime) + ',' + str(time) + ',' + "%.2f" %maximum + ',' + "%2f" %minimum + ',' + "%2f" %average + ',' + inRangeString + '\n'
		summaryfile.write(summaryString)

#------------------------------------------------------------------

					#analyzeData() calls the functions to output for each of the sensors
def analyzeData():      
	for i in range(NUM_SENSORS):
		createBins(SENSOR_INFO[i])

		if SENSOR_INFO[i].analysis == "On-Peak Off-Peak %":
			onPeakOffPeakAnalysis(SENSOR_INFO[i])

		elif SENSOR_INFO[i].analysis == "Min-Max":
			minMaxAnalysis(SENSOR_INFO[i])


#==================================================================
#-------------------------MAIN APPLICATION-------------------------
#==================================================================

binArray = []

for i in range(NUM_SENSORS):
	binArray.append(Bins(i))

analyzeData()

#==================================================================
#-----------------Tell the website the pi is not busy--------------
#==================================================================

file = open('/home/cjk36/Desktop/CERF-DAQ/WebPage/pages/analysisStatus.txt', "w")
file.write("0")
file.close()




