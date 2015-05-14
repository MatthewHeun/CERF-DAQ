# ********************************************************************** #
# CERF PI LUX CENSOR READINGS                                            #
#                                                                        #
# Takes in readings from the lux sensor and prints them to a file        #
#                                                                        #
# Created by Curtis Kortman                                              #
# Started: 3/15/15                                                       #
# Last Edited: 12/05/15                                                  #
# ********************************************************************** #

# **************************IMPORTS************************************* #
import time
import datetime
import re
import os
import pytz
from Adafruit_ADS1x15 import ADS1x15
from global_vars import*
#<<<<<<< HEAD
#==================================================================
#------------------------------LUX SENSOR--------------------------
#==================================================================

ADS1115 = 0x01	# 16-bit ADC

# Initialize the ADC using the default mode (use default I2C address)
# Set this to ADS1015 or ADS1115 depending on the ADC you are using!
adc = ADS1x15(ic=ADS1115)

# Read channel 0, 1, and 2 in single-ended mode, +/-4.096V, 250sps

volts0 = adc.readADCSingleEnded(0, 4096, 250) / 1000
volts1 = adc.readADCSingleEnded(1, 4096, 250) / 1000
volts2 = adc.readADCSingleEnded(2, 4096, 250) / 1000
	
lux0 = pow(10, volts0)
lux1 = pow(10, volts1)
lux2 = pow(10, volts2)

# **************************INITIALIZE VARIABLES************************ #

debug = False # used for helping in development of code, turn to false for normal operation

# ********** Updated Automatically with "sensor_edit" command ********** #
nameOfPi = str(Pi_Number)  #from global_vars flie
# Enter the path here for where you want the files stored
path = '/home/pi/Desktop/Data/Pi_1_Raw/'  
# Could enter more descriptive names if desired
sensor1 = '1'
sensor2 = '2'
sensor3 = '3'
sensor1_long = Sensor_1  #from global_vars file
sensor2_long = Sensor_2
sensor3_long = Sensor_3
# **********************FUNCTION DEFINITIONS***************************** #  

    
# outputLux() calls the functions to output for each of the sensors
def outputLux():      
    writeFile(sensor1)
    writeFile(sensor2)
    writeFile(sensor3)
        

# writeFile() checks for the directory of a given year to exist, creates that 
# directory if it does not exist, and then writes the output to a .txt file
# for the readings based on the time
def writeFile(sensor):
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
    filename = ('Pi_'+ nameOfPi +'_'+ sensor +'_'+ datetime.datetime.strftime(datetime.datetime.now(), '%Y-%m-%d') + '.csv')
    
    if not os.path.isfile(filename):
    	filetest = open(filename, 'w')
	filetest.write("#Calvin College CERF PI DATA"+ '\n')
	filetest.close()
	filetest = open(filename, 'a')
 	filetest.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Light[LUX]"+ '\n')
    else:
	filetest = open(filename, 'a')

    # write all time and sensor data to the file
    local = pytz.timezone("America/Detroit")
    naive = datetime.datetime.now()
    local_dt = local.localize(naive, is_dst = None)
    time_local = datetime.datetime.strftime(datetime.datetime.now(), '%Y-%m-%d %H:%M:%S')
    time_utc = datetime.datetime.strftime(local_dt.astimezone(pytz.utc), '%Y-%m-%dT%H:%M:%S')


    if (sensor == '1'):
	filetest.write(nameOfPi + ',' + sensor + ',' + sensor1_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux0 + '\n')
    if (sensor == '2'):
	filetest.write(nameOfPi + ',' + sensor + ',' + sensor2_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux1 + '\n')
    if (sensor == '3'):
	filetest.write(nameOfPi + ',' + sensor + ',' + sensor3_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux2 + '\n')
    filetest.close()
    
while(1):
    outputLux()
    if not debug:
        break
    time.sleep(5)






