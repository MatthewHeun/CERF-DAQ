# ********************************************************************** #
# CERF PI LUX CENSOR Analysis                                            #
#                                                                        #
# Analysis readings from lux sensors for summary data                    #
#                                                                        #
# Started by Derek De Young                                              #
# Continued by Curtis Kortman						 #
# Started: 4/25/15                                                       #
# Last Edited: 7/13/15                                                   #
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
from globalVars import*  # Global vars (also includes the sensor class) [anything that has sensor.#### comes from here]

#==================================================================
#-------------------Tell the website the pi is busy----------------
#==================================================================
cwd = os.getcwd()
datadir = cwd[:(len(cwd) - 8)] + "Data/"

file = open(cwd + '/WebPage/pages/analysisStatus.txt', "w")
file.write("1")
file.close()

#==================================================================
#------------------------Initialize Variables----------------------
#==================================================================

debug = False # used for helping in development of code, turn to false for normal operation

nameOfPi = str(PI_NUMBER) # From Global Vars 
month_list= ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"]
#Base directory leading to the summary
summary_path = datadir + 'Pi_' + nameOfPi + '_Summary/'
#Base directory leading to the raw
raw_path = datadir + 'Pi_' + nameOfPi + '_Raw/'
year = datetime.datetime.strftime(datetime.datetime.now(), '%Y')



#==================================================================
#------------------------Function Definitions----------------------
#==================================================================

#------------------------------------------------------------------

#initializeSummary() writes the metadata to each file
def initializeSummary(sensor, analysisNumber):
	filename = (summary_path + 'Pi_' + nameOfPi + '_'+ str(sensor.number) + 'a' + str(analysisNumber + 1) + '.csv')
	newfile = open(filename, 'w')
	newfile.write("#Calvin College CERF PI DATA"+ '\n')
	newfile.close()
	return filename

#------------------------------------------------------------------
					
					#delcares the path to the data based on the organizational structur of the raw data
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
					
					#returns the date in a datetime format from a filename as written by the GetData.py file 
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
	#print str(date1) + ' ' + str(checkDate) + ' ' + str(date2)
	#print (checkDate >= date1) and (checkDate < date2)
	if ((checkDate >= date1) and (checkDate < date2)):
		return True
	else:
		return False

#------------------------------------------------------------------
					
#finds the earliest year for a sensor's data collection, using the organizational structure from the data collection
def getFirstYear(sensor):
	years = []
	for name in os.listdir(raw_path + 'Sensor' + str(sensor.number) + '/'):
		years.append(name)
	return min(years)

#------------------------------------------------------------------
					
#finds the earliest month for a sensor's data collection, using the organizational structure from the data collection
def getFirstMonth(sensor, year):
	months = []
	for name in os.listdir(raw_path + 'Sensor' + str(sensor.number) + '/' + year + '/'):
		months.append(name)
	return min(months)

#------------------------------------------------------------------
					
#finds the earliest day for a sensor's data collection, using the organizational structure from the data collection
def getFirstDay(sensor, year, month):
	days = []
	for name in os.listdir(raw_path + 'Sensor' + str(sensor.number) + '/' + year + '/' + month + '/'):
		days.append(name)
	days = ((min(days).split('-')[2]).split('.')[0]) 	#the date format looks like YY-MM-DD.otherstuff so it splits it into an array of [YY][MM][DD.otherstuff] 
	return days	 					#and takes index 2 aka [DD.otherstuff] and then performs the same process to remove the .otherstuff

#------------------------------------------------------------------
					
					#finds the earliest date of a sensor's data collection by combining the earliest yeaer, month, and day
def getFirstDate(sensor):
	firstYear = getFirstYear(sensor)
	firstMonth = getFirstMonth(sensor, firstYear)
	firstDay = getFirstDay(sensor, firstYear, firstMonth)
	return datetime.datetime.strptime(firstYear + ' ' + firstMonth + ' ' + firstDay, "%Y %m %d")

#------------------------------------------------------------------
					
					#creates a list of start and stop times divided by years
def createYearBins(sensor, analysisNumber):
	firstYear = int(getFirstYear(sensor))
	today = datetime.datetime.today()
	endYear = int(today.year)

	startHour = datetime.datetime.strptime("00 00", "%H %M").time()
	endHour = datetime.datetime.strptime("23 59 59", "%H %M %S").time()

	for x in range(endYear-firstYear+1):
		startTime = (str(firstYear) + '-' + "01" + '-' + "01" + ' ' + str(startHour))
		stopTime = (str(firstYear) + '-' + "12" + '-' + str(calendar.monthrange(int(firstYear), 12)[1])+ ' ' + str(endHour))
		binArray[analysisNumber][sensor.number-1].addBin(startTime, stopTime)
		firstYear += 1

#------------------------------------------------------------------

					#creates a list of start and stop times divided by months
def createMonthBins(sensor, analysisNumber):
	firstDate = getFirstDate(sensor)
	today = datetime.datetime.today()

	startHour = datetime.datetime.strptime("00 00", "%H %M").time()
	endHour = datetime.datetime.strptime("23 59 59", "%H %M %S").time()

	for x in range(monthsDiff(today, firstDate)+1):
		startTime = (str(firstDate.year) + '-' + str(firstDate.month) + '-' + "01" + ' ' + str(startHour))
		stopTime = (str(firstDate.year) + '-' + str(firstDate.month) + '-' + str((calendar.monthrange(int(firstDate.year), int(firstDate.month)))[1]) + ' ' + str(endHour))
		binArray[analysisNumber][sensor.number-1].addBin(startTime, stopTime)
		firstDate = addMonth(firstDate)

#------------------------------------------------------------------
#creates a list of start and stop times divided by days
def createDayBins(sensor, analysisNumber):
	firstDate = getFirstDate(sensor)
	today = datetime.datetime.today()

	startHour = datetime.datetime.strptime("00 00", "%H %M").time()
	endHour = datetime.datetime.strptime("23 58 59", "%H %M %S").time()

	for x in range(int((today-firstDate).days)+1):
		startTime = (str(firstDate.year) + '-' + str(firstDate.month) + '-' + str(firstDate.day) + ' ' + str(startHour))
		stopTime = (str(firstDate.year) + '-' + str(firstDate.month) + '-' + str(firstDate.day) + ' ' + str(endHour))
		binArray[analysisNumber][sensor.number-1].addBin(startTime, stopTime)
		firstDate += datetime.timedelta(days=1)
		#print "Start time: " + startTime + " Stop Time: " + stopTime

#------------------------------------------------------------------
#creates a list of start and stop times based on the user input on the webpage
def createCustomBins(sensor, analysisNumber):
	firstDate = getFirstDate(sensor)
	today = datetime.datetime.today()
	startHour = int(sensor.customStart[analysisNumber])
	endHour = int(sensor.customStop[analysisNumber])

	if startHour < 10:
		startHour = '0' + str(startHour) # the datetime strings only work with numbers in 01, 02, 03.... format
	if endHour < 10:
		endHour = '0' + str(endHour)

	startHour = datetime.datetime.strptime(str(startHour), "%H").time()
	endHour = datetime.datetime.strptime(str(endHour), "%H").time()

	for x in range(int((today-firstDate).days+1)):
		startTime = (str(firstDate.year) + '-' + str(firstDate.month) + '-' + str(firstDate.day) + ' ' + str(startHour))
		stopTime = (str(firstDate.year) + '-' + str(firstDate.month) + '-' + str(firstDate.day) + ' ' + str(endHour))
		for day in sensor.weekdays[analysisNumber]:
			if str(day) == str(firstDate.weekday()):
				binArray[analysisNumber][sensor.number-1].addBin(startTime, stopTime)
		firstDate += datetime.timedelta(days=1)

#------------------------------------------------------------------
#creates a list of start and stop times based on the data of a sensor

def createSensorBins(sensor, analysisNumber):
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
	olderTime = ""

	yearList = []
	for x in range(endYear - firstYear + 1): 		#provides the number of year folders that have to be opened
		yearList.append(str(firstYear))
		firstYear += 1

	for year in yearList:
		for month in month_list: 					#probides the number of month folders that have to be opened
			filepath = raw_path + 'Sensor' + str(sensor.fromSensorNumber[analysisNumber]) + '/' + year + '/' + month
			fileList = []
			if os.path.exists(filepath):
				for file in os.listdir(filepath):
					fileList.append(file)
				fileList.sort()						#if the files are not sorted, bins can strech randomly for days or skip whole days as the dates are not appearing on chronological order
				for file in fileList:
					#print file
					file = open(filepath + '/' + file)
					for line in file:				#reads every line in each year^ and month^ folder
						#print line
						if line[0].isdigit():				#ignore the metadata
							row = re.split(',',line)		#turn the line into an array of data, based on its csv delimeters
							time = getDateFromDataString(row[4])	#the time the data is recorded was saved in the 5th column
							data = row[5].replace('\n','')	#the data was saved in the 6th column, but it also contains the invisible new line delimeter
							
							if sensor.fromSensorMin[analysisNumber] == "":	#if the user has not declared a minimum - treat it as 0
								Min = 0
							else:
								Min = sensor.fromSensorMin[analysisNumber]

							if sensor.fromSensorMax[analysisNumber] == "":
								Max = 0
							else:
								Max = sensor.fromSensorMax[analysisNumber]
							if ((float(data) >= float(Min)) and (float(data) < float(Max))):
								inRangeNow = True
							else:
								inRangeNow = False
							if ((inRangeNow == True) and (inRangeBefore == False)):	#if the data wasn't in the threshold before, and it is now. Mark it down as a start time
								if str(oldTime) == "":
									binArray[analysisNumber][sensor.number-1].addStartTime(str(time))
								else:
									binArray[analysisNumber][sensor.number-1].addStartTime(str(oldTime-datetime.timedelta(seconds = 15)))
								end = False
							if ((inRangeNow == False) and (inRangeBefore == True)): #if the data was in range before, and it isn't now. Mark it down as a stop time. 
								if str(oldTime) == "":
									binArray[analysisNumber][sensor.number-1].addStopTime(str(time))
								else:
									binArray[analysisNumber][sensor.number-1].addStopTime(str(olderTime+datetime.timedelta(seconds = 15)))
								end = True
							inRangeBefore = inRangeNow
							olderTime = oldTime
							oldTime = time

	if end != True:		#mark the last data point as a stop time
		if len(binArray[analysisNumber][sensor.number-1].timeArray) != 0:
			binArray[analysisNumber][sensor.number-1].addStopTime(str(time))

#------------------------------------------------------------------
					#creates a list of start and stop times based on configuration data

def createBins(sensor, analysisNumber):
	if sensor.analysis != "On-Peak Off-Peak %":
		if sensor.binType[analysisNumber] == "From Sensor":
			createSensorBins(sensor, analysisNumber)
		elif sensor.binType[analysisNumber] == "Day":
			createDayBins(sensor, analysisNumber)
		elif sensor.binType[analysisNumber] == "Month":
			createMonthBins(sensor, analysisNumber)
		elif sensor.binType[analysisNumber] == "Custom Time":
			createCustomBins(sensor, analysisNumber)
		elif sensor.binType[analysisNumber] == "Year":
			createYearBins(sensor, analysisNumber)

#------------------------------------------------------------------
					#takes the data from "from sensor" or "custom time" and summarizes it by month or year

def aggregateMinMaxData(sensor, analysisNumber):
	filename = (summary_path + 'Pi_' + nameOfPi + '_'+ str(sensor.number) + 'a' + str(analysisNumber + 1) + '.csv')
	summaryfile = open(filename, 'r')
	lastStart = ""
	lastEnd = ""
	minArrayInRange = []
	maxArrayInRange = []
	aveArrayInRange = []
	maximumInRange = 0
	minimumInRange = 0
	averageInRange = 0
	durationInRange = []
	minArrayOutOfRange= []
	maxArrayOutOfRange= []
	aveArrayOutOfRange= []
	maximumOutOfRange= 0
	minimumOutOfRange= 0
	averageOutOfRange= 0
	durationOutOfRange = []
	summarystring = ""
	end = False

	for line in summaryfile:
		if line[0].isdigit():							#ignore the metadata
			row = re.split(',',line)					#turn csv into array
			startTime = getDateFromDataString(row[3])
			endTime = getDateFromDataString(row[4])
			timeLapse = endTime - startTime
			if row[8].replace('\n','') == "In Range":	#if the data was in the time range, add it to in range counters
				minArrayInRange.append(float(row[5]))
				maxArrayInRange.append(float(row[6]))
				aveArrayInRange.append(float(row[7]))
				durationInRange.append((divmod(timeLapse.days * 86400 + timeLapse.seconds, 60))[0]) # calculates the number of minutes between the two datapoints
			else:
				minArrayOutOfRange.append(float(row[5]))	#if the data was out of the time range, add it to out of range counters
				maxArrayOutOfRange.append(float(row[6]))
				aveArrayOutOfRange.append(float(row[7]))
				durationOutOfRange.append((divmod(timeLapse.days * 86400 + timeLapse.seconds, 60))[0])
			startTime = getDateFromDataString(row[3])
			endTime = getDateFromDataString(row[4])
			
			end = False

			if sensor.summaryMethod[analysisNumber] == "Month":
				if lastStart != "":
					if lastStart.month != startTime.month: #if the data has moved from one month to the next then...
						totalInRange = 0
						totalOutOfRange = 0
						durationInRangeTotal = 0
						durationOutOfRangeTotal = 0 
						for x in range(len(durationInRange)):	#create a weighted average based on how much time elapsed between each bin
							totalInRange += durationInRange[x] * aveArrayInRange[x]
							durationInRangeTotal += durationInRange[x]
						for x in range(len(durationOutOfRange)):
							totalOutOfRange += durationOutOfRange[x] * aveArrayOutOfRange[x]
							durationOutOfRangeTotal += durationOutOfRange[x]
						maximumInRange = max(maxArrayInRange)
						minimumInRange = min(minArrayInRange)
						averageInRange = float(totalInRange)/float(durationInRangeTotal)
						maximumOutOfRange = max(maxArrayOutOfRange)
						minimumOutOfRange = min(minArrayOutOfRange)
						averageOutOfRange = float(totalOutOfRange)/float(durationOutOfRangeTotal) 	#calculate the mins, and maxes
						summarystring += str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastStart.replace(day=1, hour=0, minute=0, second=0, microsecond=0)) + ',' + str((startTime.replace(day=1, hour=23, minute=59, second=59, microsecond=0)-datetime.timedelta(days = 1))) + ',' + "%.2f" %minimumInRange + ',' + "%.2f" %maximumInRange + ',' + "%.2f" %averageInRange + ",In Range" + '\n'
						summarystring += str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastStart.replace(day=1, hour=0, minute=0, second=0, microsecond=0)) + ',' + str((startTime.replace(day=1, hour=23, minute=59, second=59, microsecond=0)-datetime.timedelta(days = 1))) + ',' + "%.2f" %minimumOutOfRange + ',' + "%.2f" %maximumOutOfRange + ',' + "%.2f" %averageOutOfRange + ",Out of Range" + '\n'
						maxArrayInRange = []		#^^ and write that data to the summary file
						minArrayInRange = []
						aveArrayInRange = []		#Now clear the counters so they are ready to keep track of the next month
						maxArrayOutOfRange = []
						minArrayOutOfRange = []
						aveArrayOutOfRange = []
						durationInRange = []
						durationOutOfRange = []
						end = True

			if sensor.summaryMethod[analysisNumber] == "Year":
				if lastStart != "":
					if lastStart.year != startTime.year:	#if the data has moved to the next year...
						totalInRange = 0
						totalOutOfRange = 0
						durationInRangeTotal = 0
						durationOutOfRangeTotal = 0 
						for x in range(len(durationInRange)):	#create a weighted average based on how much time elapsed between each bin
							totalInRange += durationInRange[x] * aveArrayInRange[x]
							durationInRangeTotal += durationInRange[x]
						for x in range(len(durationOutOfRange)):
							totalOutOfRange += durationOutOfRange[x] * aveArrayOutOfRange[x]
							durationOutOfRangeTotal += durationOutOfRange[x]
						maximumInRange = max(maxArrayInRange)
						minimumInRange = min(minArrayInRange)
						averageInRange = float(totalInRange)/float(durationInRangeTotal)
						maximumOutOfRange = max(maxArrayOutOfRange)
						minimumOutOfRange = min(minArrayOutOfRange)
						averageOutOfRange = float(totalOutOfRange)/float(durationOutOfRangeTotal)	#calculate the mins, and maxes
						summarystring += str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(datetime.datetime.strptime(str(startTime.year), "%Y")) + ',' + str(datetime.datetime.strptime(str(startTime.year) + " 12 31 23 59 59", "%Y %m %d %H %M %S")) + ',' + "%.2f" %minimumInRange + ',' + "%.2f" %maximumInRange + ',' + "%.2f" %averageInRange + ",In Range" + '\n'
						summarystring += str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(datetime.datetime.strptime(str(startTime.year), "%Y")) + ',' + str(datetime.datetime.strptime(str(startTime.year) + " 12 31 23 59 59", "%Y %m %d %H %M %S")) + ',' + "%.2f" %minimumOutOfRange + ',' + "%.2f" %maximumOutOfRange + ',' + "%.2f" %averageOutOfRange + ",Out of Range" + '\n'
						maxArrayInRange = []		#^^ and write that data to the summary file
						minArrayInRange = []
						aveArrayInRange = []		#Now clear the counters so they are ready to keep track of the next year
						maxArrayOutOfRange = []
						minArrayOutOfRange = []
						aveArrayOutOfRange = []
						durationInRange = []
						durationOutOfRange = []
						end = True

			lastStart = startTime
	if not end:
		totalInRange = 0
		totalOutOfRange = 0
		durationInRangeTotal = 0
		durationOutOfRangeTotal = 0 
		for x in range(len(durationInRange)):	#create a weighted average based on how much time elapsed between each bin
			totalInRange += durationInRange[x] * aveArrayInRange[x]
			durationInRangeTotal += durationInRange[x]
		for x in range(len(durationOutOfRange)):
			totalOutOfRange += durationOutOfRange[x] * aveArrayOutOfRange[x]
			durationOutOfRangeTotal += durationOutOfRange[x]
	
		if len(maxArrayInRange) != 0: 
			maximumInRange = max(maxArrayInRange)
		else: 
			maximumInRange = 8888888.88
		if len(minArrayInRange) != 0:
			minimumInRange = min(minArrayInRange)
		else:
			minimumInRange = -8888888.88
		if durationInRangeTotal == 0:
			durationInRangeTotal = 1
		
		averageInRange = float(totalInRange)/float(durationInRangeTotal)
		maximumOutOfRange = max(maxArrayOutOfRange)
		minimumOutOfRange = min(minArrayOutOfRange)
		averageOutOfRange = float(totalOutOfRange)/float(durationOutOfRangeTotal)	#calculate the mins, and maxes
		if sensor.summaryMethod[analysisNumber] == "Month":
			summarystring += str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastStart.replace(day=1, hour=0, minute=0, second=0, microsecond=0)) + ',' + str((startTime.replace(day=1, hour=23, minute=59, second=59, microsecond=0)-datetime.timedelta(days = 1))) + ',' + "%.2f" %minimumInRange + ',' + "%.2f" %maximumInRange + ',' + "%.2f" %averageInRange + ",In Range" + '\n'
			summarystring += str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastStart.replace(day=1, hour=0, minute=0, second=0, microsecond=0)) + ',' + str((startTime.replace(day=1, hour=23, minute=59, second=59, microsecond=0)-datetime.timedelta(days = 1))) + ',' + "%.2f" %minimumOutOfRange + ',' + "%.2f" %maximumOutOfRange + ',' + "%.2f" %averageOutOfRange + ",Out of Range" + '\n'
		if sensor.summaryMethod[analysisNumber] == "Year":
			summarystring += str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(datetime.datetime.strptime(str(startTime.year), "%Y")) + ',' + str(datetime.datetime.strptime(str(startTime.year) + " 12 31 23 59 59", "%Y %m %d %H %M %S")) + ',' + "%.2f" %minimumInRange + ',' + "%.2f" %maximumInRange + ',' + "%.2f" %averageInRange + ",In Range" + '\n'
			summarystring += str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(datetime.datetime.strptime(str(startTime.year), "%Y")) + ',' + str(datetime.datetime.strptime(str(startTime.year) + " 12 31 23 59 59", "%Y %m %d %H %M %S")) + ',' + "%.2f" %minimumOutOfRange + ',' + "%.2f" %maximumOutOfRange + ',' + "%.2f" %averageOutOfRange + ",Out of Range" + '\n'
	summaryfile.close()

	initializeSummary(sensor, analysisNumber)		#since it is going to write over the same file it is reading from, up until this point the new file info has been saved in a string
	filename = (summary_path + 'Pi_' + nameOfPi + '_'+ str(sensor.number) + 'a' + str(analysisNumber + 1) + '.csv')
	summaryfile = open(filename, 'a')
	summarystringHeader = "#Pi_Number,Sensor_Number," + str(sensor.name) + ",Start Time,End Time,Max,Min,Ave,In/Out of Range" + '\n'
	summaryfile.write(summarystringHeader)
	summaryfile.write(summarystring)		#the string is now written to the summary file, over top of the non-aggregated information
	summaryfile.close()

#------------------------------------------------------------------
					#takes the data from "from sensor" or "custom time" and summarizes it by month or year

def aggregateRangeData(sensor, analysisNumber):
	filename = (summary_path + 'Pi_' + nameOfPi + '_'+ str(sensor.number) + 'a' + str(analysisNumber + 1) + '.csv')	#navigate to the sumamry file
	summaryfile = open(filename, 'r')
	lastStart = ""
	lastEnd = ""
	onPercentArrayInRange = []
	onPercentageInRange = 0
	onPercentArrayOutOfRange= []
	onPercentageOutOfRange= 0
	durationInRange = []
	durationOutOfRange = []
	summarystring = ""
	end = False

	for line in summaryfile:
		if line[0].isdigit():								#ignore the metadata
			row = re.split(',',line)						#create an array out of the csv
			startTime = getDateFromDataString(row[3])
			endTime = getDateFromDataString(row[4])
			timeLapse = endTime - startTime
			if row[6].replace('\n','') == "In Range":		#save the data to in range data if it is within the desired time range
				onPercentArrayInRange.append(float(row[5]))
				durationInRange.append((divmod(timeLapse.days * 86400 + timeLapse.seconds, 60))[0]) # calculates the number of minutes between the two datapoints
			else:
				onPercentArrayOutOfRange.append(float(row[5]))	#otherwise save the data to out of range 
				durationOutOfRange.append((divmod(timeLapse.days * 86400 + timeLapse.seconds, 60))[0])
			end = False

			if sensor.summaryMethod[analysisNumber] == "Month":
				if lastStart != "":
					if lastStart.month != startTime.month:		#if the month has changed 
						totalInRange = 0
						totalOutOfRange = 0
						durationInRangeTotal = 0
						durationOutOfRangeTotal = 0 			#set the totals to 0
						for x in range(len(durationInRange)):	#create a weighted average based on how much time elapsed between each bin
							totalInRange += durationInRange[x] * onPercentArrayInRange[x]
							durationInRangeTotal += durationInRange[x]
						for x in range(len(durationOutOfRange)):
							totalOutOfRange += durationOutOfRange[x] * onPercentArrayOutOfRange[x]
							durationOutOfRangeTotal += durationOutOfRange[x]
						onPercentageInRange = float(float(totalInRange) / float(durationInRangeTotal))
						onPercentageOutOfRange = float(float(totalOutOfRange) / float(durationOutOfRangeTotal))
						summarystring += str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastStart.replace(day=1, hour=0, minute=0, second=0, microsecond=0)) + ',' + str((startTime.replace(day=1, hour=23, minute=59, second=59, microsecond=0)-datetime.timedelta(days = 1))) + ',' + "%.2f" %onPercentageInRange + ",In Range" + '\n'
						summarystring += str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastStart.replace(day=1, hour=0, minute=0, second=0, microsecond=0)) + ',' + str((startTime.replace(day=1, hour=23, minute=59, second=59, microsecond=0)-datetime.timedelta(days = 1))) + ',' + "%.2f" %onPercentageOutOfRange + ",Out of Range" + '\n'
						onPercentArrayInRange = []				#^^ write the data to the file and 
						onPercentArrayOutOfRange= []			# put the counters back to 0
						durationInRange = []
						durationOutOfRange = []
						end = True

			if sensor.summaryMethod[analysisNumber] == "Year":
				if lastStart != "":
					if lastStart.year != startTime.year: 		#if the year has changed 
						totalInRange = 0
						totalOutOfRange = 0
						durationInRangeTotal = 0
						durationOutOfRangeTotal = 0 			#set the totals to 0
						for x in range(len(durationInRange)): 	#create a weighted average based on how much time elapsed between each bin
							totalInRange += durationInRange[x] * onPercentArrayInRange[x]
                                                        durationInRangeTotal += durationInRange[x]
						for x in range(len(durationOutOfRange)):
							totalOutOfRange += durationOutOfRange[x] * onPercentArrayOutOfRange[x]
							durationOutOfRangeTotal += durationOutOfRange[x]
						onPercentageInRange = float(float(totalInRange) / float(durationInRangeTotal))
						onPercentageOutOfRange = float(float(totalOutOfRange) / float(durationOutOfRangeTotal))
						summarystring += str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(datetime.datetime.strptime(str(startTime.year), "%Y")) + ',' + str(datetime.datetime.strptime(str(startTime.year) + " 12 31 23 59 59", "%Y %m %d %H %M %S")) + ',' + "%.2f" %onPercentageInRange + ",In Range" + '\n'
						summarystring += str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(datetime.datetime.strptime(str(startTime.year), "%Y")) + ',' + str(datetime.datetime.strptime(str(startTime.year) + " 12 31 23 59 59", "%Y %m %d %H %M %S")) + ',' + "%.2f" %onPercentageOutOfRange + ",Out of Range" + '\n'
						onPercentArrayInRange = [] 				#^^ write the data to the file and 
						onPercentArrayOutOfRange= [] 			# put the counters back to 0
						durationInRange = []
						durationOutOfRange = []
						end = True

			lastStart = startTime

	if not end: 				#If the analysis does not end on a whole month or year, write the data for the partial timeframe
		totalInRange = 0
		totalOutOfRange = 0
		durationInRangeTotal = 0
		durationOutOfRangeTotal = 0
		for x in range(len(durationInRange)):
			totalInRange += durationInRange[x] * onPercentArrayInRange[x]
			durationInRangeTotal += durationInRange[x]
		for x in range(len(durationOutOfRange)):
			totalOutOfRange += durationOutOfRange[x] * onPercentArrayOutOfRange[x]
			durationOutOfRangeTotal += durationOutOfRange[x]
		if (durationInRangeTotal == 0):
			durationInRangeTotal = 1
		if (durationOutOfRangeTotal == 0):
			durationOutOfRangeTotal = 1
		onPercentageInRange = float(float(totalInRange) / float(durationInRangeTotal))
		onPercentageOutOfRange = float(float(totalOutOfRange) / float(durationOutOfRangeTotal))
		if sensor.summaryMethod[analysisNumber] == "Month":
			summarystring += str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastStart.replace(day=1, hour=0, minute=0, second=0, microsecond=0)) + ',' + str((startTime.replace(day=calendar.monthrange(startTime.year, startTime.month)[1], hour=23, minute=59, second=59, microsecond=0))) + ',' + "%.2f" %onPercentageInRange + ",In Range" + '\n'
			summarystring += str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastStart.replace(day=1, hour=0, minute=0, second=0, microsecond=0)) + ',' + str((startTime.replace(day=calendar.monthrange(startTime.year, startTime.month)[1], hour=23, minute=59, second=59, microsecond=0))) + ',' + "%.2f" %onPercentageOutOfRange + ",Out of Range" + '\n'
		if sensor.summaryMethod[analysisNumber] == "Year":
			summarystring += str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(datetime.datetime.strptime(str(startTime.year), "%Y")) + ',' + str(datetime.datetime.strptime(str(startTime.year) + " 12 31 23 59 59", "%Y %m %d %H %M %S")) + ',' + "%.2f" %onPercentageInRange + ",In Range" + '\n'
			summarystring += str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(datetime.datetime.strptime(str(startTime.year), "%Y")) + ',' + str(datetime.datetime.strptime(str(startTime.year) + " 12 31 23 59 59", "%Y %m %d %H %M %S")) + ',' + "%.2f" %onPercentageOutOfRange + ",Out of Range" + '\n'
	summaryfile.close()


	initializeSummary(sensor, analysisNumber)
	filename = (summary_path + 'Pi_' + nameOfPi + '_'+ str(sensor.number) + 'a' + str(analysisNumber+1) + '.csv')
	summaryfile = open(filename, 'a')
	summarystringHeader = "#Pi_Number,Sensor_Number," + str(sensor.name) + ",Start Time,End Time,On Percentage,In/Out of Range" + '\n'
	summaryfile.write(summarystringHeader)		#since we are writing over the summary file, up intil this point the new information is saved in a string
	summaryfile.write(summarystring)			#the new information now overwrites the old
	summaryfile.close()
#------------------------------------------------------------------
# determines if the data was high during set hours, or high during off set hours
def onPeakOffPeakAnalysis(sensor, analysisNumber):
	initializeSummary(sensor, analysisNumber)
	filename = (summary_path + 'Pi_' + nameOfPi + '_'+ str(sensor.number) + 'a' + str(analysisNumber+1) + '.csv')
	summaryfile = open(filename, 'a')
	summaryString = "#Pi_Number,Sensor_Number,Sensor Name,Year,Month,High-Peak %,Mid-Peak %,Low-Peak %,Off-Peak %" + '\n'
	summaryfile.write(summaryString)

	firstDate = getFirstDate(sensor)		#get the first datapoint time
	today = datetime.datetime.today()		#get the time of today

	minutesOn_Peak = 0
	minutesMid_Peak = 0
	minutesLow_Peak = 0
	minutesOn_OffPeak = 0
	totalMinutes_Peak = 0
	totalMinutes_MidPeak = 0
	totalMinutes_LowPeak = 0
	totalMinutes_OffPeak = 0

	startYear = int(firstDate.year)			
	startMonth = int(firstDate.month)

	summaryString = ""

	for x in range(monthsDiff(today, firstDate)+1):		#for the number of months between the first datapoint and today...
		if int(startMonth) < 10:
			startMonth = "0" + str(startMonth)

		filePath = raw_path + 'Sensor' + str(sensor.number) + '/' + str(startYear) + '/' + str(startMonth) + '/'	#navigate to the correct month folder

		if os.path.exists(filePath):
			fileList = []
			for file in os.listdir(filePath):
				fileList.append(file)
			fileList.sort()
			for file in fileList:

				file = open(filePath + file)
				for line in file:
					if line[0].isdigit():	#ignore the metadata
						row = re.split(',',line)	#convert the csv line to an array
						time = row[4]
						data = row[5].replace('\n','')
						time = getDateFromDataString(time)
						
						if sensor.thresholdMin[analysisNumber] == "":	#if the user did not imput a min - assume 0
							Min = 0
						else:
							Min = sensor.thresholdMin[analysisNumber]
						
						if sensor.thresholdMax[analysisNumber] == "":	#if the user did not imput a max - assume 0
							Max = 0
						else:
							Max = sensor.thresholdMax[analysisNumber]
							
						peakDay = False	
						if time.weekday() in PEAK_WEEKDAY: #if a weekday
							peakDay = True
						if (time.month >= 6 and time.month < 9): #if in the summer months
                                                        print(str(time.hour) + "  " + str(time.weekday()) + "  " + str(peakDay) + "  " + str(PEAK_WEEKDAY))
							if ((time.hour >= START_TIME_HIGH_summer and time.hour < STOP_TIME_HIGH_summer) and peakDay): 	#if above the threshold during peak hours add to minutes on peak
                                                                #print(str(time.hour) + "  " + str(data) + "  High")
								totalMinutes_Peak += 1
								if (float(data) > float(Min)) and (float(data) < float(Max)):
									minutesOn_Peak += 1  #adding to the high peak
							elif (((time.hour >= START_TIME_MID_summer and time.hour < START_TIME_HIGH_summer) or (time.hour >= STOP_TIME_HIGH_summer and time.hour < STOP_TIME_MID_summer))) and peakDay: # elif statement for mid peak
                                                                #print(str(time.hour) + "  " + str(data) + "  Mid")
								totalMinutes_MidPeak += 1
								if (float(data) > float(Min)) and (float(data) < float(Max)):
									minutesMid_Peak += 1
							elif (((time.hour >= START_TIME_LOW_summer and time.hour < START_TIME_MID_summer) or (time.hour >= STOP_TIME_MID_summer and time.hour < STOP_TIME_LOW_summer)) and peakDay): # elif statement for low peak
                                                                #print(str(time.hour) + "  " + str(data) + "  Low")
								totalMinutes_LowPeak += 1
								if (float(data) > float(Min)) and (float(data) < float(Max)):
									minutesLow_Peak += 1
							else:		                        #otherwise add to minutes off peak
                                                                #print(str(time.hour) + "  " + str(data) + "  Off")
                                                                totalMinutes_OffPeak += 1
                                                                if (float(data) > float(Min)) and (float(data) < float(Max)):
                                                                        minutesOn_OffPeak += 1
						else:    #if in the winter months
							if ((time.hour >= START_TIME_HIGH_winter and time.hour < STOP_TIME_HIGH_winter) and peakDay): 	#if above the threshold during peak hours add to minutes on peak
								totalMinutes_Peak += 1
								if (float(data) > float(Min)) and (float(data) < float(Max)):
									minutesOn_Peak += 1  #adding to the high peak
							elif (((time.hour >= START_TIME_MID_winter and time.hour < START_TIME_HIGH_winter) or (time.hour >= STOP_TIME_HIGH_winter and time.hour < STOP_TIME_MID_winter)) and peakDay): # elif statement for mid peak
								totalMinutes_MidPeak += 1
								if (float(data) > float(Min)) and (float(data) < float(Max)):
									minutesMid_Peak += 1
                                                        else:															#otherwise add to minutes off peak
								totalMinutes_OffPeak += 1
								if (float(data) > float(Min)) and (float(data) < float(Max)):
									minutesOn_OffPeak += 1
		if totalMinutes_Peak == 0:
			totalMinutes_Peak = 1
		if totalMinutes_MidPeak == 0:
			totalMinutes_MidPeak = 1
		if totalMinutes_LowPeak == 0:
			totalMinutes_LowPeak = 1
		if totalMinutes_OffPeak == 0:
			totalMinutes_OffPeak = 1
		onPeakPercentage = float(100 * (float(minutesOn_Peak) / float(totalMinutes_Peak)))
		midPeakPercentage = float(100* (float(minutesMid_Peak) / float(totalMinutes_MidPeak)))
		lowPeakPercentage = float(100* (float(minutesLow_Peak) / float(totalMinutes_LowPeak)))
		offPeakPercentage = float(100 * (float(minutesOn_OffPeak) / float(totalMinutes_OffPeak)))
		summaryString = nameOfPi + ',' + str(sensor.number) + ',' + sensor.name + ',' + str(startYear) + ',' + str(startMonth) + ',' + "%.2f" %onPeakPercentage + ',' + "%.2f" %midPeakPercentage + ',' + "%.2f" %lowPeakPercentage + ',' + "%.2f" %offPeakPercentage + "\n"
		summaryfile.write(summaryString)		#at the end of the month, write the data to the file, and reset the counters

		minutesOn_Peak = 0
		minutesMid_Peak = 0
		minutesLow_Peak = 0
		minutesOn_OffPeak = 0
		totalMinutes_Peak = 0
		totalMinutes_MidPeak = 0
		totalMinutes_LowPeak = 0
		totalMinutes_OffPeak = 0

		startMonth  = int(startMonth) + 1
		if startMonth > 12:
			startMonth = 1
			startYear += 1

#-----------------------------------------------------------------------

def kWhAnalysis(sensor, analysisNumber):
	initializeSummary(sensor, analysisNumber)
	filename = (summary_path + 'Pi_' + nameOfPi + '_'+ str(sensor.number) + 'a' + str(analysisNumber+1) + '.csv')
	summaryfile = open(filename, 'a')
	summaryString = "#Pi_Number,Sensor_Number,Sensor Name,Year,Month,kWh On-Peak,kWh Off-Peak" + '\n'
	summaryfile.write(summaryString)

	firstDate = getFirstDate(sensor)		#get the first datapoint time
	today = datetime.datetime.today()		#get the time of today

	kWhOn_Peak = 0
	kWhOn_OffPeak = 0

	startYear = int(firstDate.year)			
	startMonth = int(firstDate.month)

	summaryString = ""

	for x in range(monthsDiff(today, firstDate)+1):		#for the number of months between the first datapoint and today...
		if int(startMonth) < 10:
			startMonth = "0" + str(startMonth)

		filePath = raw_path + 'Sensor' + str(sensor.number) + '/' + str(startYear) + '/' + str(startMonth) + '/'	#navigate to the correct month folder

		if os.path.exists(filePath):
			fileList = []
			for file in os.listdir(filePath):
				fileList.append(file)
			fileList.sort()
			for file in fileList:
				file = open(filePath + file)
				for line in file:
					if line[0].isdigit():	#ignore the metadata
						row = re.split(',',line)	#convert the csv line to an array
						time = row[4]
						data = row[5].replace('\n','')
						time = getDateFromDataString(time)

						peakDay = False
						if time.weekday() in PEAK_WEEKDAY:
							peakDay = True
						if (time.hour >= START_TIME and time.hour < STOP_TIME and peakDay): 	#if during peak hours add to kWh on peak
							kWhOn_Peak += float(data) / 60.0
						else:															#otherwise add to minutes off peak
							kWhOn_OffPeak += float(data) / 60.0

		summaryString = nameOfPi + ',' + str(sensor.number) + ',' + sensor.name + ',' + str(startYear) + ',' + str(startMonth) + ',' + "%.2f" %kWhOn_Peak + ',' + "%.2f" %kWhOn_OffPeak + "\n"
		summaryfile.write(summaryString)		#at the end of the month, write the data to the file, and reset the counters

		kWhOn_Peak = 0
		kWhOn_OffPeak = 0

		startMonth  = int(startMonth) + 1
		if startMonth > 12:
			startMonth = 1
			startYear += 1

#-----------------------------------------------------------------------
#onPeakOffPeakAnalysis - checks for the on% for the on peak and off peak hours as defined by the electrical grid
def rangeAnalysis(sensor, analysisNumber):
	initializeSummary(sensor, analysisNumber)
	filename = (summary_path + 'Pi_' + nameOfPi + '_'+ str(sensor.number) + 'a' + str(analysisNumber+1) + '.csv')
	summaryfile = open(filename, 'a')
	summaryString = "#Pi_Number,Sensor_Number,Sensor Name,Start Time,End Time,On%,In/Out of Range" + '\n'
	summaryfile.write(summaryString)

	firstDate = getFirstDate(sensor)
	lastTime = firstDate
	time = firstDate
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

	for x in range(monthsDiff(today, firstDate)+1):		#for every month in between the first datapoint to today...
		if int(startMonth) < 10:
			startMonth = "0" + str(startMonth)

		filePath = raw_path + 'Sensor' + str(sensor.number) + '/' + str(startYear) + '/' + str(startMonth) + '/' #navigate to the right folder

		if os.path.exists(filePath):
			fileList = []
			for file in os.listdir(filePath):
				fileList.append(file)
			fileList.sort()
			for file in fileList:
				#print file
				fileDate = getDateFromFile(file)
				file = open(filePath + file)
				for line in file:
					if line[0].isdigit():				#ignore the metadata
						row = re.split(',',line)	#turn the csv lines into an array.
						time = row[4]
						data = row[5].replace('\n','')
						time = getDateFromDataString(time)	#get the time the data was taken from the string
						if firstTimeThrough:
							lastTime = time;
						#if sensor.number == 1:
							#print time
						if ((len(binArray[analysisNumber][sensor.number-1].timeArray)) > 1 and (dateInRange(time, binArray[analysisNumber][sensor.number-1].timeArray[binIndex][0], binArray[analysisNumber][sensor.number-1].timeArray[binIndex][1]))):
							inRangeNow = True 				#if the time is within the range bin, inrange = true 			
							#print "Hello"
						else:	
							inRangeNow = False 				#else false
						if sensor.thresholdMin[analysisNumber] == "":		#if the user didn't enter a threshold treat it as 0
							Min = 0
						else:
							Min = sensor.thresholdMin[analysisNumber]

						if sensor.thresholdMax[analysisNumber] == "":		#if the user didn't enter a threshold treat it as 0
							Max = 0
						else:
							Max = sensor.thresholdMax[analysisNumber]

						if (float(data) > float(Min)) and (float(data) < float(Max)): 
							minutesOn += 1
						else:
							minutesOff += 1

						totalMinutes += 1

						end = False

						if ((inRangeNow == True) and (False == inRangeBefore) and (not firstTimeThrough)): #if the data has moved into a bin, printout the analysis for the out of bin range data
							percentOn = (float(minutesOn) / float(totalMinutes))*100
							summaryString = str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastTime) + ',' + str(time) + ',' + "%.2f" %percentOn + ",Not in Range" + '\n'
							if (sensor.binType != "Day" and sensor.binType != "Month"):
								summaryfile.write(summaryString)
								lastTime = time + datetime.timedelta(0,60)
							minutesOn = 0
							minutesOff = 0
							totalMinutes = 0
							if (sensor.binType == "Day" or sensor.binType == "Month"):
								if (float(data) > float(Min)):
									minutesOn += 1
									totalMinutes += 1
								else:
									minutesOff += 1
									totalMinutes += 1
							end = True

						if ((inRangeNow == False) and (True == inRangeBefore)):		#if the data has moved out of a bin, printout the analysis for the in bin range data
							percentOn = (float(minutesOn) / float(totalMinutes))*100
							summaryString = str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastTime) + ',' + str(time) + ',' + "%.2f" %percentOn + ",In Range" + '\n'
							summaryfile.write(summaryString)
							if binIndex < (len(binArray[analysisNumber][sensor.number-1].timeArray)-1):
								binIndex += 1
							minutesOn = 0
							minutesOff = 0
							totalMinutes = 0 
							lastTime = time + datetime.timedelta(0,60)	
							end = True

						inRangeBefore = inRangeNow
						firstTimeThrough = False

		startMonth  = int(startMonth) + 1
		if startMonth > 12:
			startMonth = 1
			startYear += 1

	if not end:		#if the data didn't end with the start or end of a binrange, print out the remaining analyzed data
		inRangeString = ""
		if inRangeNow:
			inRangeString = "In Range"
		else:
			inRangeString = "Out of Range"
		if totalMinutes == 0:
			totalMinutes = 1
		percentOn = (float(minutesOn) / float(totalMinutes))*100
		summaryString = str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastTime) + ',' + str(time) + ',' + "%.2f" %percentOn + ',' + inRangeString + '\n'
		summaryfile.write(summaryString)
	summaryfile.close()
	
	if ((sensor.binType[analysisNumber] == "Custom Time" or sensor.binType[analysisNumber] == "From Sensor") and sensor.summaryMethod[analysisNumber] != "None"):

		aggregateRangeData(sensor, analysisNumber)


#------------------------------------------------------------------

						#determines the min and max the user defined in range, and out of range hours
def minMaxAnalysis(sensor, analysisNumber):
	initializeSummary(sensor, analysisNumber)
	filename = (summary_path + 'Pi_' + nameOfPi + '_'+ str(sensor.number) + 'a' + str(analysisNumber+1) + '.csv')
	summaryfile = open(filename, 'a')
	summaryString = "#Pi_Number,Sensor_Number,Sensor Name,Start Time,End Time,Max,Min,Ave,In/Out of Range" + '\n'
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
	summaryDataInRange = []
	summaryDataOutOfRange = []

	startYear = int(firstDate.year)
	startMonth = int(firstDate.month)

	for x in range(monthsDiff(today, firstDate)+1): #iterate through the months starting with the first data point, and moving to today
		if int(startMonth) < 10:
			startMonth = "0" + str(startMonth)

		filePath = raw_path + 'Sensor' + str(sensor.number) + '/' + str(startYear) + '/' + str(startMonth) + '/' #change the directory to the appropriate month folder

		if os.path.exists(filePath):
			fileList = []
			for file in os.listdir(filePath):
				fileList.append(file)
			fileList.sort()
			for file in fileList:					#go through all of the files in each month folder
				fileDate = getDateFromFile(file)
				file = open(filePath + file)
				for line in file:					#check each data point in each file
					if line[0].isdigit():
						row = re.split(',',line)	#turn csv line into an array
						time = row[4]
						data = row[5].replace('\n','')
						time = getDateFromDataString(time)
						if firstTimeThrough:		
							lastTime = time;
						if ((len(binArray[analysisNumber][sensor.number-1].timeArray)) > 0 and dateInRange(time, binArray[analysisNumber][sensor.number-1].timeArray[binIndex][0], binArray[analysisNumber][sensor.number-1].timeArray[binIndex][1])): #if the bin range isn't empty check if the time is in or out of the bin range 
							inRangeNow = True
						else:	
							inRangeNow = False
						
						if (float(data) > float(maximum)):
							maximum = float(data)
						if (float(data) < float(minimum)):
							minimum = float(data)

						average += float(data)
						totalMinutes += 1
						end = False

						if ((inRangeNow == True) and (False == inRangeBefore) and (not firstTimeThrough)): #if the time moves into a valid bin range, print the out of bin range analyzed data
							average = (float(average) / float(totalMinutes))
							summaryString = str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastTime) + ',' + str(time) + ',' + "%.2f" %minimum + ',' + "%.2f" %maximum + ',' + "%.2f" %average + ",Out of Range" + '\n'
							summaryDataOutOfRange.append([maximum, minimum, average])
							if (sensor.binType != "Day" and sensor.binType != "Month"):
								summaryfile.write(summaryString)
							maximum = 0.0 		#re-initialze counters
							minimum = 100000.0
							average = 0.0
							totalMinutes = 0.0
							lastTime = time + datetime.timedelta(0,60)
							end = True
							#print "Writing to file"
							if (sensor.binType == "Day" or sensor.binType == "Month"): # correction so that consecutive bin ranges (no gaps in between) move seemlessly from one bin range to the next
								average += float(data)
								totalMinutes += 1

						if ((inRangeNow == False) and (True == inRangeBefore)):	#if the time moves out of a valid bin range, print the in bin range analyzed data
							average = float((float(average) / float(totalMinutes)))
							summaryString = str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastTime) + ',' + str(time) + ',' + "%.2f" %minimum + ',' + "%.2f" %maximum + ',' + "%.2f" %average + ",In Range" + '\n'
							summaryDataInRange.append([maximum, minimum, average])
							summaryfile.write(summaryString)
							if binIndex < (len(binArray[analysisNumber][sensor.number-1].timeArray)-1):
								binIndex += 1
							maximum = 0.0 		#re -initialize counters
							minimum = 100000.0
							average = 0.0
							totalMinutes = 0.0
							lastTime = time + datetime.timedelta(0,60)
							end = True

						inRangeBefore = inRangeNow
						firstTimeThrough = False

		startMonth  = int(startMonth) + 1
		if startMonth > 12:
			startMonth = 1
			startYear += 1	
	
	if not end:						#if the last data point did not finish off a bin, print the partial bin analyzed data 
		inRangeString = ""
		if inRangeNow:
			inRangeString = "In Range"
		else:
			inRangeString = "Out of Range"
		average = float((float(average) / float(totalMinutes)))
		summaryString = str(PI_NUMBER) + ',' + str(sensor.number) + ',' + str(sensor.name) + ',' + str(lastTime) + ',' + str(time) + ',' + "%.2f" %minimum + ',' + "%.2f" %maximum + ',' + "%.2f" %average + ',' + inRangeString + '\n'
		summaryfile.write(summaryString)
	summaryfile.close()

	if sensor.binType[analysisNumber] == "Custom Time" or sensor.binType[analysisNumber] == "From Sensor":
		if sensor.summaryMethod[analysisNumber] != "None":
			aggregateMinMaxData(sensor, analysisNumber)

#------------------------------------------------------------------

#analyzeData() calls the functions to output for each of the sensors
def analyzeData():

	percentComplete = "0%"
	file = open(cwd + '/WebPage/pages/analysisPercentage.txt', "w")
	#print percentComplete
	file.write(str(percentComplete))
	file.close()

	percentIndex = 1
	for c in range(3):
		for i in range(NUM_SENSORS):
			if int(SENSOR_INFO[i].numberOfAnalysis) > c:
				#time.sleep(2)
				#print str(SENSOR_INFO[i].numberOfAnalysis) + ' ' + str(c)
				createBins(SENSOR_INFO[i], c)
				if SENSOR_INFO[i].analysis[c] == "On-Peak Off-Peak %":
					onPeakOffPeakAnalysis(SENSOR_INFO[i], c)
					#print 'Performing Peak Percent Analysis: ' + 'Sensor Number: ' + str(SENSOR_INFO[i].number) + ' Analysis Number: ' + str(c+1)
				elif SENSOR_INFO[i].analysis[c] == "Range Analysis":
					rangeAnalysis(SENSOR_INFO[i], c)
					#print 'Performing Range Analysis: ' + 'Sensor Number: ' + str(SENSOR_INFO[i].number) + ' Analysis Number: ' + str(c+1)
				elif SENSOR_INFO[i].analysis[c] == "Min-Max":
					minMaxAnalysis(SENSOR_INFO[i], c)
					#print 'Performing Min-Max Anlysis: ' + 'Sensor Number: ' + str(SENSOR_INFO[i].number) + ' Analysis Number: ' + str(c+1)
				elif SENSOR_INFO[i].analysis[c] == "kWh":
					kWhAnalysis(SENSOR_INFO[i], c)
					#print 'Permorming kWh Analysis: ' + Sensor Number: ' + str(SENSOR_INFO[i].number) + ' Analysis Number: ' + str(c+1)			
			file = open(cwd + '/WebPage/pages/analysisPercentage.txt', "w")
			percentComplete = float(float(percentIndex)/float((3)*(NUM_SENSORS)))*100
			percentComplete = "%.2f" %percentComplete + '%'
			#print percentComplete
			file.write(str(percentComplete))
			file.close()
			percentIndex += 1;
	
	percentComplete = "100%"
	file = open(cwd + '/WebPage/pages/analysisPercentage.txt', "w")
	#print percentComplete
	file.write(str(percentComplete))
	file.close()
	time.sleep(2)


#==================================================================
#-------------------------MAIN APPLICATION-------------------------
#==================================================================

binArray = [[],[],[]]

for c in range(3):
	for i in range(NUM_SENSORS):
		binArray[c].append(Bins(i))

analyzeData()

#print len(binArray[0][0].timeArray)

#for x in range(len(binArray[0][0].timeArray)):
	#print "Start: " + str(binArray[0][0].timeArray[x][0]) + " Stop: " + str(binArray[0][0].timeArray[x][1])

#==================================================================
#-----------------Tell the website the pi is not busy--------------
#==================================================================

file = open(cwd + '/WebPage/pages/analysisStatus.txt', "w")
file.write("0")
file.close()

#==================================================================
#--------------KEEP THIS LINE FOR THE STATUS LOG-------------------
#==================================================================

print "Data Analysis succeeded:" +  str(datetime.datetime.now())




