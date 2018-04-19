#!/bin/bash

set -e
set -v

cp UnitTest/piNumber.txt -r WebPage/pages
cp UnitTest/numSensors.txt -r WebPage/pages
cp UnitTest/newPeakTimes.txt -r WebPage/pages
cp UnitTest/reset.txt -r WebPage/pages
cp UnitTest/sensorInfo.txt -r WebPage/pages
cp UnitTest/dataCollectionSet.txt -r WebPage/pages
for pi in Pi_-1_Raw Pi_-1_Summary
do
	for sensorNum in Sensor1 Sensor2
	do
		for year in 2015 2016 2017 2018
		do
			for month in 01 02 03 04 05 06 07 08 09 10 11 12
			do
				echo '/home/travis/build/MatthewHeun/Data/$pi/$SensorNum/$year/$month/'
				mkdir -p /home/travis/build/MatthewHeun/Data/$pi/$SensorNum/$year/$month/
			done
		done
	done
done
echo "for loop successful"