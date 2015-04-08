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
import os
# from Adafruit_I2C.py import *

# **************************INITIALIZE VARIABLES************************ #

debug = True # used for helping in development of code, turn to false for normal operation

# ******************COULD BE CHANGED AUTOMATICALLY********************** #
# Find a way to read this from pi itself
nameOfPi = 'Pi1' 
# This is currently set to Curtis' computer not the PI
# Enter the path here for where you want the files stored
path = 'D:\Eclipse\CERF_i2c_LUXSENSOR\Python'  
# Could enter more descriptive names if desired
sensor1 = 'Sensor1'
sensor2 = 'Sensor2'
sensor3 = 'Sensor3'
# This value should be replaced with the LUX readings inside of outputLux()
value = 1

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
    fullpath = (path + '\\' + sensor)
    
    if debug:
        print ('directory: ' + fullpath)
        print ('This directory exists' + str(os.path.exists(fullpath)))
    
    if not os.path.exists(fullpath): # creates the sensor folder if it does not exist
        os.makedirs(fullpath)    
        
    # changes the filepath to include a year
    fullpath = fullpath + '\\' + datetime.datetime.strftime(datetime.datetime.now(), '%Y')
        
    if not os.path.exists(fullpath): # creates the year folder if it does not exist
        os.makedirs(fullpath)
        
    os.chdir(fullpath) # navigate into the sensor and year folder
    
    # create a file for the day if it does not exist, else open for appending
    filename = (nameOfPi + sensor + datetime.datetime.strftime(datetime.datetime.now(), '%Y_%m_%d') + '.txt')
    filetest = open(filename, 'a')  
    global value
    
    # write all time and sensor data to the file
    time = datetime.datetime.strftime(datetime.datetime.now(), '%Y_%m_%d_%H:%M')
    filetest.write(nameOfPi + ' ' + sensor + ' ' + time + ' Reading: ' + str(value) + '\n')
    filetest.close()
    value += 1
    
while(debug):
    outputLux()
    if not debug:
        break
    time.sleep(5)





