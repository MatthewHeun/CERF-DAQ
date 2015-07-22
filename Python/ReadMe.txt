This folder contains all of the python files running on the pi...

Adafruit_ADS1x15: contains the library that allows simple commands to interface with the analog to digital converter. Without it, one would have to send commands using hexadecimal numbers to certain registers on the ADC to receive another string of bits back that must be interpreted as the voltage. With it however, interfacing with the device is very simple. It is included in the sensorClass.py file, as the sensorClass determines how each sensor receives its data. 

Adafruit_I2C: just like the previous file it contains the library to make interfacing with I2C simple and straightforward. 

Analyze.py: contains the script that analyzes ALL of the data on the pi. is run every night at midnight by a chron job.  

binClass.py: makes it easy to add bins and keep them organized in time order, it is included in Analyze.py

getData.py: is run by a chron job every minute, to college the data and write it to the appropriate file. 

globalVars.py: reads in the same data that the globalVars.php file does aka the webpage/pages/sensorInfo.txt file. It uses the sensorClass.py to keep the information organized by sensor. 

runAnalysis.sh: is a shell command called by a chron job at midnight to run the analysis python script. 

runPython.sh: is a shell command called by a chron job every minute to collect the data. It runs the getdata python file. 

sensorClass.py: contains the format for the organization of all of the sensor information
