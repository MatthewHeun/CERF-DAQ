index.php: the default landing page for the website, as it is the default landing page for Apache 2.

configuration.php: the configuration page of the website

sensor.php: is the page for all of the sensors. Form data is submitted with the name 'sensorNumber' to control which one of the sensors is displayed. Go ahead and look at the URL to witness this behavior

analyze.php: is the page where a button can be pressed to run the python analysis script. Otherwise this will run automatically every night around midnight. 

piNumber.txt: is created at the setup of the pi with the setup script, and really can't be changed unless one goes through the setup again. 

analysisStatus.txt: a 1 is written to this file at the begginning of running the analysis script. A 0 is written when it is finished. This is how the website can tell if the pi is running the analysis or not. 

numSensors.txt: this file is written by the configuration page and can be changed there

sensorInfo.txt: this file contains ALL OF THE INFORMATION for the operation of data collection and analysis used by both python and php. It is rewritten entirely every time the configuration page form data is submitted. The form does save any values that weren't changed. However, the order is the most important part. This is how the values for the global variables are determined. They are read in line-by-line, and the order determines which variable they are assigned to. 
