# ********************************************************************** #
# CERF PI LUX CENSOR Analysis                                            #
#                                                                        #
# Analyziz readings from lux sensors for summary data                    #
#                                                                        #
# Created by Derek De Young                                              #
# Started: 4/25/15                                                       #
# Last Edited: 4/25/15                                                    #
# ********************************************************************** #

# **************************IMPORTS************************************* #
import time
import datetime
import smbus
import re
import os
import re  #line delimiter
from datetime import date
#<<<<<<< HEAD
#==================================================================
#------------------------------DEFAULT LIST------------------------
#==================================================================

month_list= ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"]
#Base directory leading to the summary
summary_path = '/home/pi/Desktop/Data/Pi_1_Summary/'
#Base directory leading to the raw
raw_path = '/home/pi/Desktop/Data/Pi_1_Raw/'
year = datetime.datetime.strftime(datetime.datetime.now(), '%Y')
# **************************LIGHT ON TOLERANCE************************ #
light_tol = 6
low_peak_time = 7
high_peak_time = 19
# **************************INITIALIZE VARIABLES************************ #
debug = False # used for helping in development of code, turn to false for normal operation

# ******************COULD BE CHANGED AUTOMATICALLY********************** #
# Find a way to read this from pi itself
nameOfPi = 'Pi_1' 
sensor1 = '1'
sensor2 = '2'
sensor3 = '3'
# **********************FUNCTION DEFINITIONS***************************** #  

    
# analyzeLux() calls the functions to output for each of the sensors
def analyzeLux():      
    AnalyzeLightSensor(sensor1)
    AnalyzeLightSensor(sensor2)
    AnalyzeLightSensor(sensor3)
        

def AnalyzeLightSensor(sensor):
    full_raw_path = (raw_path + 'Sensor ' + sensor + '/' + year + '/')
    filename = (summary_path + '/' + nameOfPi + '_'+ sensor + '_' + year + '.csv')
    summaryfile = open(filename, 'w')
    summaryfile.write("#Calvin College CERF PI DATA"+ '\n')
    summaryfile.close()
    summaryfile = open(filename, 'a')
    summaryfile.write("Pi_Number,Sensor_Number,Year,On_Peak,Off_Peak" + '\n')

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
		summaryfile.write(nameOfPi + ',' + sensor + ',' + month + ',0.00,0.00\n')
	else:
		for file in os.listdir(full_raw_path + month):
			file = open(full_raw_path + month + '/' + file)
			count = 0
			for line in file:
				if count < 2:
					count += 1
				else:
					row = re.split(',',line)
					time = row[2]
					light = row[3].replace('\n','')
					if 'e' in light:
						light = '0'
					hour = time[-8:-6]
					day = time[8:10]
					weekday = date(int(year),int(month),int(day)).weekday()
					#print(str(weekday))
					peak_hour = int(hour) >= low_peak_time and int(hour) <= high_peak_time
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
    			#print(str(total_min_on_peak))
			#print(str(min_on_peak))
			file.close()
		if total_min_on_peak != 0:
    			percentage_on_peak = (float(min_on_peak)/total_min_on_peak)*100
		else:
			percentage_on_peak = 0
		if total_min_off_peak != 0:
			percentage_off_peak = (float(min_off_peak)/total_min_off_peak)*100
		else:
			percentage_off_peak = 0
		summaryfile.write(nameOfPi + ',' + sensor + ',' + month + ',' + "%.2f" %percentage_on_peak +','+ "%.2f" %percentage_off_peak +'\n')
		print(nameOfPi + ',' + sensor + ',' + month + ',' + "%.2f" %percentage_on_peak +','+ "%.2f" %percentage_off_peak +'\n')		
while(1):
    analyzeLux()
    if not debug:
        break
    time.sleep(5)





