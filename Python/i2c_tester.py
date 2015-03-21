import Adafruit_I2C
from Adafruit_I2C import *
import LUX_sensor
from LUX_sensor import *
import re
import smbus
import time

#=================================================================
#------------------------Initialization---------------------------
#=================================================================

print("Initializing the Pi i2c commands")
print("Getting Pi Revision #: ")
print (Adafruit_I2C.getPiRevision())
print("")
print("Getting Pi i2c Bus #: ")
print (Adafruit_I2C.getPiI2CBusNumber())
print("")

address	= 0x39					#The default i2c address
luxsensor = Adafruit_I2C(address = address)	#Initialize i2c Communication on the specified adress

#=================================================================
#----------------------------Power Up-----------------------------
#=================================================================

print("Powering up device...")

control = 0x00					
#Control register for the power up function

power_on = 0x03					
#Value to be set for power up

luxsensor.write8(control, power_on)
time.sleep(1)
#delay of one second to alow ADC to begin function
luxsensor.readU8(control)
print("Device is powered on")
print("")			
luxsensor.writeRaw8(0b10100011)
#turn interrupt function off
print("Disabling the interrupts")
disable = 0b00000000
interrupt = 0x06
luxsensor.write8(disable, interrupt)

#=================================================================
#-------------------------Reading Values--------------------------
#=================================================================

command = 0x00	
for x in range (0,16):

	low = luxsensor.readU8(reg = command)		#Reads the lower Data register
	command += 1					#Increments the command bit to the higher Data register
	#high = luxsensor.readU16(reg = command)	#Reads the higher Data register

	#high = high*256					#shifts the high value into upper byte

	#print(high+low)