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
from global_vars import*  # Global vars
#<<<<<<< HEAD
#==================================================================
#------------------------------DEFAULT LIST------------------------
#==================================================================
nameOfPi = str(Pi_Number) # From Global Vars 
month_list= ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"]
#Base directory leading to the summary
summary_path = '/home/pi/Desktop/Data/Pi_' + nameOfPi + '_Summary/'
#Base directory leading to the raw
raw_path = '/home/pi/Desktop/Data/Pi_' + nameOfPi + '_Raw/'
year = datetime.datetime.strftime(datetime.datetime.now(), '%Y')
print(year)
if not os.path.exists(summary_path):
	os.makedirs(summary_path)
# **************************LIGHT ON TOLERANCE************************ #
light_tol = Sensor_tol   # from global_vars
low_peak_time = PeakTime1 # from global_vars
high_peak_time = PeakTime2 # from global_vars
# **************************INITIALIZE VARIABLES************************ #
debug = False # used for helping in development of code, turn to false for normal operation

# ******************COULD BE CHANGED AUTOMATICALLY********************** #
sensors = [Sensor_1, Sensor_2, Sensor_3, Sensor_4, Sensor_5, Sensor_6, Sensor_7, Sensor_8, Sensor_9, Sensor_10, Sensor_11, Sensor_12, Sensor_13, Sensor_14, Sensor_15, Sensor_16] #Sensor_X is from Gloabl Vars for discriptive name
# **********************FUNCTION DEFINITIONS***************************** #  

    
# analyzeLux() calls the functions to output for each of the sensors
def analyzeLux():      
	i = 1
	while (i <= Number_of_Sensors):
    	AnalyzeLightSensor(str(i), sensors[i-1]) 
		i += 1
		 
  
def AnalyzeLightSensor(sensor, sensor_discrip):
    full_raw_path = (raw_path + 'Sensor ' + sensor + '/' + year + '/')
    filename = (summary_path + '/Pi_' + nameOfPi + '_'+ sensor + '_' + year + '.csv')
    summaryfile = open(filename, 'w')
    summaryfile.write("#Calvin College CERF PI DATA"+ '\n')
    summaryfile.close()
    summaryfile = open(filename, 'a')
    summaryfile.write("#Pi_Number,Sensor_Number,Sensor_Name,Year,Month,On_Peak%,Off_Peak%" + '\n')

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
while(1):
    analyzeLux()
    if not debug:
        break
    time.sleep(5)





