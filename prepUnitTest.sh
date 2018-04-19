#!/bin/bash

set -e
set -v

cp UnitTest/piNumber.txt -r WebPage/pages
cp UnitTest/numSensors.txt -r WebPage/pages
cp UnitTest/newPeakTimes.txt -r WebPage/pages
cp UnitTest/reset.txt -r WebPage/pages
cp UnitTest/sensorInfo.txt -r WebPage/pages
cp UnitTest/dataCollectionSet.txt -r WebPage/pages

for sensorNum in Sensor1 Sensor2
do
	mkdir -p /home/travis/build/MatthewHeun/Data/Pi_3_Raw/$sensorNum/
	wget -P /home/travis/build/MatthewHeun/Data/Pi_3_Raw/$sensorNum/ "https://raw.githubusercontent.com/pjh26/UnitTestData/master/$sensorNum.zip"
	unzip /home/travis/build/MatthewHeun/Data/Pi_3_Raw/$sensorNum/$sensorNum.zip
done

