#!/bin/bash

set -e

cp UnitTest/piNumber.txt -r WebPage/pages
cp UnitTest/numSensors.txt -r WebPage/pages
cp UnitTest/newPeakTimes.txt -r WebPage/pages
cp UnitTest/reset.txt -r WebPage/pages
cp UnitTest/sensorInfo.txt -r WebPage/pages
cp UnitTest/dataCollectionSet.txt -r WebPage/pages

for sensorNum in Sensor1 Sensor2 Sensor3
do
	mkdir -p /home/travis/build/MatthewHeun/Data/Pi_3_Raw/$sensorNum/
	wget -P /home/travis/build/MatthewHeun/Data/Pi_3_Raw/$sensorNum/ "https://raw.githubusercontent.com/pjh26/UnitTestData/master/$sensorNum.zip"
	unzip -d /home/travis/build/MatthewHeun/Data/Pi_3_Raw/$sensorNum/ /home/travis/build/MatthewHeun/Data/Pi_3_Raw/$sensorNum/$sensorNum.zip
done

mkdir /home/travis/build/MatthewHeun/Data/Pi_3_Summary/

if grep "CERF-DAQ/Scripts" /etc/profile
then
	echo "Bash file set up correctly" 
else
	echo "PATH=""$""PATH:/home/travis/build/MatthewHeun/CERF-DAQ/Scripts" >> /etc/profile
	echo "PATH=""$""PATH:/home/travis/build/MatthewHeun/Python" >> /etc/profile
	echo "export PATH" >> /etc/profile
fi
echo "	+Done"