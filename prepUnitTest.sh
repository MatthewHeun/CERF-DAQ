#!/bin/bash
$ set -e
$ set -v
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
				mkdir -p "/home/travis/build/MatthewHeun/Data/$pi/$SensorNum/$year/$month/"
			done
		done
	done
done
echo "for loop successful"

mkdir /home/travis/build/MatthewHeun/Data/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Summary/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor1/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor2/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor1/year/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor2/year/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor1/year/01/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor1/year/02/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor1/year/03/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor1/year/04/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor1/year/05/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor1/year/06/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor1/year/07/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor1/year/08/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor1/year/09/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor1/year/10/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor1/year/11/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor1/year/12/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor2/year/01/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor2/year/02/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor2/year/03/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor2/year/04/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor2/year/05/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor2/year/06/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor2/year/07/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor2/year/08/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor2/year/09/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor2/year/10/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor2/year/11/
mkdir /home/travis/build/MatthewHeun/Data/Pi_-1_Raw/Sensor2/year/12/