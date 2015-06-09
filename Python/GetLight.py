# ********************************************************************** #
# CERF PI LUX CENSOR READINGS                                            #
#                                                                        #
# Takes in readings from the lux sensor and prints them to a file        #
#                                                                        #
# Created by Curtis Kortman                                              #
# Started: 3/15/15                                                       #
# Last Edited: 09/06/15                                                  #
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

##### Initialize the ADC's #####

				#Define type
ADS1115 = 0x01			# 16-bit ADC (would be 0x00 for the 12bit ADC)



				#Initialize ADC 1: always (Default address 0x48)
adc0 = ADS1x15(ic = ADS1115)
				#Initialize ADC 2: if there are more than four sensors (address 0x49 - addr pin connected to VDD)
if Number_of_Sensors > 4:
    adc1 = ADS1x15(ic = ADS1115, address = 0x49)

##### Take the readings #####
				# Read the # of channels based on the number of sensors
volts1 = adc0.readADCSingleEnded(0, 4096, 250) / 1000
volts2 = adc0.readADCSingleEnded(1, 4096, 250) / 1000
volts3 = adc0.readADCSingleEnded(2, 4096, 250) / 1000
volts4 = adc0.readADCSingleEnded(3, 4096, 250) / 1000

if Number_of_Sensors > 4:
    volts5 = adc1.readADCSingleEnded(0, 4096, 250) / 1000
    volts6 = adc1.readADCSingleEnded(1, 4096, 250) / 1000
    volts7 = adc1.readADCSingleEnded(2, 4096, 250) / 1000
    volts8 = adc1.readADCSingleEnded(3, 4096, 250) / 1000

if Number_of_Sensors > 8:
    volts9 = 1
    volts10 = 1
    volts11 = 1
    volts12 = 1

if Number_of_Sensors > 12:
    volts13 = 1
    volts14 = 1
    volts15 = 1
    volts16 = 1

##### Convert the voltage readings to lux #####

lux1 = pow(10, volts1)
lux2 = pow(10, volts2)
lux3 = pow(10, volts3)
lux4 = pow(10, volts4)

if Number_of_Sensors > 4:
    lux5 = pow(10, volts5)
    lux6 = pow(10, volts6)
    lux7 = pow(10, volts7)
    lux8 = pow(10, volts8)

if Number_of_Sensors > 8:
    lux9 = pow(10, volts9)
    lux10 = pow(10, volts10)
    lux11 = pow(10, volts11)
    lux12 = pow(10, volts12)

if Number_of_Sensors > 12:
    lux13 = pow(10, volts13)
    lux14 = pow(10, volts14)
    lux15 = pow(10, volts15)
    lux16 = pow(10, volts16)


temp1 = (100 * volts1) - 50
temp2 = (100 * volts2) - 50
temp3 = (100 * volts3) - 50
temp4 = (100 * volts4) - 50

if Number_of_Sensors > 4:
    temp5 = (100 * volts5) - 50
    temp6 = (100 * volts6) - 50
    temp7 = (100 * volts7) - 50
    temp8 = (100 * volts8) - 50

if Number_of_Sensors > 8:
    temp9 = (100 * volts9) - 50
    temp10 = (100 * volts10) - 50
    temp11 = (100 * volts11) - 50
    temp12 = (100 * volts12) - 50

if Number_of_Sensors > 12:
    temp13 = (100 * volts13) - 50
    temp14 = (100 * volts14) - 50
    temp15 = (100 * volts15) - 50
    temp16 = (100 * volts16) - 50

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
sensor4 = '4'
sensor5 = '5'
sensor6 = '6'
sensor7 = '7'
sensor8 = '8'
sensor9 = '9'
sensor10 = '10'
sensor11 = '11'
sensor12 = '12'
sensor13 = '13'
sensor14 = '14'
sensor15 = '15'
sensor16 = '16'

sensor1_long = Sensor_1  #from global_vars file
sensor2_long = Sensor_2
sensor3_long = Sensor_3
sensor4_long = Sensor_2
sensor5_long = Sensor_3
sensor6_long = Sensor_2
sensor7_long = Sensor_3
sensor8_long = Sensor_2
sensor9_long = Sensor_3
sensor10_long = Sensor_2
sensor11_long = Sensor_3
sensor12_long = Sensor_2
sensor13_long = Sensor_3
sensor14_long = Sensor_2
sensor15_long = Sensor_3
sensor16_long = Sensor_2
# **********************FUNCTION DEFINITIONS***************************** #  

    
# outputLux() calls the functions to output for each of the sensors
def outputLux():      

    writeFile(sensor1)

    if Number_of_Sensors > 1:
        writeFile(sensor2)

    if Number_of_Sensors > 2:
        writeFile(sensor3)

    if Number_of_Sensors > 3:
        writeFile(sensor4)

    if Number_of_Sensors > 4:
        writeFile(sensor5)

    if Number_of_Sensors > 5:
        writeFile(sensor6)

    if Number_of_Sensors > 6:
        writeFile(sensor7)

    if Number_of_Sensors > 7:
        writeFile(sensor8)

    if Number_of_Sensors > 8:
        writeFile(sensor9)

    if Number_of_Sensors > 9:
        writeFile(sensor10)

    if Number_of_Sensors > 10:
        writeFile(sensor11)

    if Number_of_Sensors > 11:
        writeFile(sensor12)

    if Number_of_Sensors > 12:
        writeFile(sensor13)

    if Number_of_Sensors > 13:
        writeFile(sensor14)

    if Number_of_Sensors > 14:
        writeFile(sensor15)

    if Number_of_Sensors > 15:
        writeFile(sensor16)
        

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
    	file = open(filename, 'w')
	file.write("#Calvin College CERF PI DATA"+ '\n')
	file.close()
	file = open(filename, 'a')
	if (sensor == '1'):
		if (Sensor_1_Type == "Light"):
 	    		file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Light[LUX]"+ '\n')
		elif (Sensor_1_Type == "Temperature"):
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Temperature[C]"+ '\n')
		else: 
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Occupancy[Y/N]"+ '\n')
	if (sensor == '2'):
		if (Sensor_2_Type == "Light"):
 	    		file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Light[LUX]"+ '\n')
		elif (Sensor_1_Type == "Temperature"):
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Temperature[C]"+ '\n')
		else: 
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Occupancy[Y/N]"+ '\n')
	if (sensor == '3'):
		if (Sensor_3_Type == "Light"):
 	    		file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Light[LUX]"+ '\n')
		elif (Sensor_1_Type == "Temperature"):
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Temperature[C]"+ '\n')
		else: 
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Occupancy[Y/N]"+ '\n')
	if (sensor == '4'):
		if (Sensor_4_Type == "Light"):
 	    		file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Light[LUX]"+ '\n')
		elif (Sensor_1_Type == "Temperature"):
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Temperature[C]"+ '\n')
		else: 
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Occupancy[Y/N]"+ '\n')
	if (sensor == '5'):
		if (Sensor_5_Type == "Light"):
 	    		file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Light[LUX]"+ '\n')
		elif (Sensor_1_Type == "Temperature"):
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Temperature[C]"+ '\n')
		else: 
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Occupancy[Y/N]"+ '\n')
	if (sensor == '6'):
		if (Sensor_6_Type == "Light"):
 	    		file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Light[LUX]"+ '\n')
		elif (Sensor_1_Type == "Temperature"):
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Temperature[C]"+ '\n')
		else: 
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Occupancy[Y/N]"+ '\n')
	if (sensor == '7'):
		if (Sensor_7_Type == "Light"):
 	    		file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Light[LUX]"+ '\n')
		elif (Sensor_1_Type == "Temperature"):
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Temperature[C]"+ '\n')
		else: 
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Occupancy[Y/N]"+ '\n')
	if (sensor == '8'):
		if (Sensor_8_Type == "Light"):
 	    		file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Light[LUX]"+ '\n')
		elif (Sensor_1_Type == "Temperature"):
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Temperature[C]"+ '\n')
		else: 
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Occupancy[Y/N]"+ '\n')
	if (sensor == '9'):
		if (Sensor_9_Type == "Light"):
 	    		file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Light[LUX]"+ '\n')
		elif (Sensor_1_Type == "Temperature"):
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Temperature[C]"+ '\n')
		else: 
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Occupancy[Y/N]"+ '\n')
	if (sensor == '10'):
		if (Sensor_10_Type == "Light"):
 	    		file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Light[LUX]"+ '\n')
		elif (Sensor_1_Type == "Temperature"):
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Temperature[C]"+ '\n')
		else: 
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Occupancy[Y/N]"+ '\n')
	if (sensor == '11'):
		if (Sensor_11_Type == "Light"):
 	    		file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Light[LUX]"+ '\n')
		elif (Sensor_1_Type == "Temperature"):
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Temperature[C]"+ '\n')
		else: 
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Occupancy[Y/N]"+ '\n')
	if (sensor == '12'):
		if (Sensor_12_Type == "Light"):
 	    		file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Light[LUX]"+ '\n')
		elif (Sensor_1_Type == "Temperature"):
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Temperature[C]"+ '\n')
		else: 
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Occupancy[Y/N]"+ '\n')
	if (sensor == '13'):
		if (Sensor_13_Type == "Light"):
 	    		file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Light[LUX]"+ '\n')
		elif (Sensor_1_Type == "Temperature"):
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Temperature[C]"+ '\n')
		else: 
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Occupancy[Y/N]"+ '\n')
	if (sensor == '14'):
		if (Sensor_14_Type == "Light"):
 	    		file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Light[LUX]"+ '\n')
		elif (Sensor_1_Type == "Temperature"):
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Temperature[C]"+ '\n')
		else: 
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Occupancy[Y/N]"+ '\n')
	if (sensor == '15'):
		if (Sensor_15_Type == "Light"):
 	    		file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Light[LUX]"+ '\n')
		elif (Sensor_1_Type == "Temperature"):
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Temperature[C]"+ '\n')
		else: 
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Occupancy[Y/N]"+ '\n')
	if (sensor == '16'):
		if (Sensor_16_Type == "Light"):
 	    		file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Light[LUX]"+ '\n')
		elif (Sensor_1_Type == "Temperature"):
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Temperature[C]"+ '\n')
		else: 
			file.write("#Pi_Number,Sensor_Number,Discriptive_Sensor_Name,Date/Time_[UTC],Date/Time_[Local],Occupancy[Y/N]"+ '\n')
    else:
	file = open(filename, 'a')

    # write all time and sensor data to the file
    local = pytz.timezone("America/Detroit")
    naive = datetime.datetime.now()
    local_dt = local.localize(naive, is_dst = None)
    time_local = datetime.datetime.strftime(datetime.datetime.now(), '%Y-%m-%d %H:%M:%S')
    time_utc = datetime.datetime.strftime(local_dt.astimezone(pytz.utc), '%Y-%m-%dT%H:%M:%S')


    if (sensor == '1'):
	if (Sensor_1_Type == "Light"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor1_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux1 + '\n')
	elif (Sensor_1_Type == "Temperature"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor1_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %temp1 + '\n')
	else: 
		file.write(nameOfPi + ',' + sensor + ',' + sensor1_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %occ1 + '\n')
    if (sensor == '2'):
	if (Sensor_2_Type == "Light"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor2_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux2 + '\n')
	elif (Sensor_2_Type == "Temperature"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor2_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %temp2 + '\n')
	else: 
		file.write(nameOfPi + ',' + sensor + ',' + sensor2_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %occ2 + '\n')
    if (sensor == '3'):
	if (Sensor_3_Type == "Light"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor3_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux3 + '\n')
	elif (Sensor_3_Type == "Temperature"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor3_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %temp3 + '\n')
	else: 
		file.write(nameOfPi + ',' + sensor + ',' + sensor3_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %occ3 + '\n')
    if (sensor == '4'):
	if (Sensor_4_Type == "Light"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor4_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux4 + '\n')
	elif (Sensor_4_Type == "Temperature"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor4_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %temp4 + '\n')
	else: 
		file.write(nameOfPi + ',' + sensor + ',' + sensor4_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %occ4 + '\n')
    if (sensor == '5'):
	if (Sensor_5_Type == "Light"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor5_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux5 + '\n')
	elif (Sensor_5_Type == "Temperature"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor5_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %temp5 + '\n')
	else: 
		file.write(nameOfPi + ',' + sensor + ',' + sensor5_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %occ5 + '\n')
    if (sensor == '6'):
	if (Sensor_6_Type == "Light"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor6_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux6 + '\n')
	elif (Sensor_6_Type == "Temperature"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor6_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %temp6 + '\n')
	else: 
		file.write(nameOfPi + ',' + sensor + ',' + sensor6_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %occ6 + '\n')
    if (sensor == '7'):
	if (Sensor_7_Type == "Light"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor7_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux7 + '\n')
	elif (Sensor_7_Type == "Temperature"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor7_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %temp7 + '\n')
	else: 
		file.write(nameOfPi + ',' + sensor + ',' + sensor7_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %occ7 + '\n')
    if (sensor == '8'):
	if (Sensor_8_Type == "Light"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor8_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux8 + '\n')
	elif (Sensor_8_Type == "Temperature"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor8_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %temp8 + '\n')
	else: 
		file.write(nameOfPi + ',' + sensor + ',' + sensor8_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %occ8 + '\n')
    if (sensor == '9'):
	if (Sensor_9_Type == "Light"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor9_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux9 + '\n')
	elif (Sensor_9_Type == "Temperature"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor9_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %temp9 + '\n')
	else: 
		file.write(nameOfPi + ',' + sensor + ',' + sensor9_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %occ9 + '\n')
    if (sensor == '10'):
	if (Sensor_10_Type == "Light"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor10_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux10 + '\n')
	elif (Sensor_10_Type == "Temperature"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor10_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %temp10 + '\n')
	else: 
		file.write(nameOfPi + ',' + sensor + ',' + sensor10_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %occ10 + '\n')
    if (sensor == '11'):
	if (Sensor_11_Type == "Light"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor11_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux11 + '\n')
	elif (Sensor_11_Type == "Temperature"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor11_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %temp11 + '\n')
	else: 
		file.write(nameOfPi + ',' + sensor + ',' + sensor11_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %occ11 + '\n')
    if (sensor == '12'):
	if (Sensor_12_Type == "Light"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor12_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux12 + '\n')
	elif (Sensor_12_Type == "Temperature"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor12_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %temp12 + '\n')
	else: 
		file.write(nameOfPi + ',' + sensor + ',' + sensor12_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %occ12 + '\n')
    if (sensor == '13'):
	if (Sensor_13_Type == "Light"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor13_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux13 + '\n')
	elif (Sensor_13_Type == "Temperature"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor13_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %temp13 + '\n')
	else: 
		file.write(nameOfPi + ',' + sensor + ',' + sensor13_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %occ13 + '\n')
    if (sensor == '14'):
	if (Sensor_14_Type == "Light"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor14_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux14 + '\n')
	elif (Sensor_14_Type == "Temperature"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor14_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %temp14 + '\n')
	else: 
		file.write(nameOfPi + ',' + sensor + ',' + sensor14_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %occ14 + '\n')
    if (sensor == '15'):
	if (Sensor_15_Type == "Light"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor15_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux15 + '\n')
	elif (Sensor_15_Type == "Temperature"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor15_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %temp15 + '\n')
	else: 
		file.write(nameOfPi + ',' + sensor + ',' + sensor15_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %occ15 + '\n')
    if (sensor == '16'):
	if (Sensor_16_Type == "Light"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor16_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %lux16 + '\n')
	elif (Sensor_16_Type == "Temperature"):
		file.write(nameOfPi + ',' + sensor + ',' + sensor16_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %temp16 + '\n')
	else: 
		file.write(nameOfPi + ',' + sensor + ',' + sensor16_long + ',' + time_utc + ',' + time_local + ',' + "%.2f" %occ16 + '\n')
    file.close()


#==================================================================
#----------------------------Take Readings ------------------------
#==================================================================
while(1):
    outputLux()
    if not debug:
        break
    time.sleep(5)
