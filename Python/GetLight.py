# ********************************************************************** #
# CERF PI LUX CENSOR READINGS                                            #
#                                                                        #
# Takes in readings from the lux sensor and prints them to a file        #
#                                                                        #
# Created by Curtis Kortman                                              #
# Started: 3/15/15                                                       #
# Last Edited: 4/4/15                                                    #
# ********************************************************************** #

# **************************IMPORTS************************************* #
import time
import datetime
import Adafruit_I2C
from Adafruit_I2C import *
import smbus
import TSL2561
import re

#<<<<<<< HEAD
import os
# from Adafruit_I2C.py import *
#==================================================================
#------------------------------LUX SENSOR--------------------------
#==================================================================
luxsensor1 = TSL2561.TSL2561(address = 0x39)		#Initialize the sensor at i2c address 0x39
luxsensor1.setGain()					#Gain at default value of 1
luxsensor2 = TSL2561.TSL2561(address = 0x49)		#Initialize the sensor at i2c address 0x49
luxsensor2.setGain()					#Gain at default value of 1
luxsensor3 = TSL2561.TSL2561(address = 0x29)		#Initialize the sensor at i2c address 0x29
luxsensor3.setGain()

time.sleep(1)
value1 = luxsensor1.readLux()
value2 = luxsensor2.readLux()
value3 = luxsensor3.readLux()

if value1 < 1: 
	value1 = 0;
if value2 < 1:
	value2 = 0;
if value3 < 1:
	value3 = 0;

# **************************INITIALIZE VARIABLES************************ #

debug = False # used for helping in development of code, turn to false for normal operation

# ******************COULD BE CHANGED AUTOMATICALLY********************** #
# Find a way to read this from pi itself
nameOfPi = 'Pi_1' 
# Enter the path here for where you want the files stored
path = '/home/pi/Desktop/Data/Pi_1_Raw/'  
# Could enter more descriptive names if desired
sensor1 = '1'
sensor2 = '2'
sensor3 = '3'

# **********************FUNCTION DEFINITIONS***************************** #  

    
# outputLux() calls the functions to output for each of the sensors
def outputLux():      
    navigateToDirectory(sensor1)
    navigateToDirectory(sensor2)
    navigateToDirectory(sensor3)
        

# navigateToDirectory() checks for the directory of a given year to exist, creates that 
# directory if it does not exist, and then writes the output to a .txt file
# for the readings based on the time
def navigateToDirectory(sensor):
    fullpath = (path + 'Sensor ' + sensor)
    
    if debug:
        print ('directory: ' + fullpath)
        print ('This directory exists' + str(os.path.exists(fullpath)))
    
    if not os.path.exists(fullpath): # creates the sensor folder if it does not exist
        os.makedirs(fullpath)    
        
    # changes the filepath to include a year
    fullpath = fullpath + '/' + datetime.datetime.strftime(datetime.datetime.now(), '%Y')
        
    if not os.path.exists(fullpath): # creates the year folder if it does not exist
        os.makedirs(fullpath)

        # changes the filepath to include a month
    fullpath = fullpath + '/' + datetime.datetime.strftime(datetime.datetime.now(), '%m')
        
    if not os.path.exists(fullpath): # creates the month folder if it does not exist
        os.makedirs(fullpath)
        
    os.chdir(fullpath) # navigate into the sensor and year folder
    
    # create a file for the day if it does not exist, else open for appending
    filename = (nameOfPi +'_'+ sensor +'_'+ datetime.datetime.strftime(datetime.datetime.now(), '%Y-%m-%d') + '.csv')
    
    if not os.path.isfile(filename):
    	filetest = open(filename, 'w')
	filetest.write("#Calvin College CERF PI DATA"+ '\n')
	filetest.close()
	filetest = open(filename, 'a')
 	filetest.write("Pi_Number,Sensor_Number,Date/Time,Light"+ '\n')
    else:
	filetest = open(filename, 'a')

    # write all time and sensor data to the file
    time = datetime.datetime.strftime(datetime.datetime.now(), '%Y-%m-%d %H:%M:%S')

    if (sensor == '1'):
	filetest.write(nameOfPi + ',' + sensor + ',' + time + ',' + "%.2f" %value1 + '\n')
    if (sensor == '2'):
	print(nameOfPi + ',' + sensor + ',' + time + ',' + str(value2) + '\n')
	filetest.write(nameOfPi + ',' + sensor + ',' + time + ',' + "%.2f" %value2 + '\n')
    if (sensor == '3'):
	filetest.write(nameOfPi + ',' + sensor + ',' + time + ',' + "%.2f" %value3 + '\n')
    filetest.close()
    
while(1):
    outputLux()
    if not debug:
        break
    time.sleep(5)






