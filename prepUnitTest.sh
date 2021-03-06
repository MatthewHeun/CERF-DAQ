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

sudo chmod ugo+rwx /home/travis/build/MatthewHeun/Data/Pi_3_Raw/Sensor1/2017/03/Pi_1_1_2017-03-01.csv
sudo chmod ugo+rwx /home/travis/build/MatthewHeun/Data/Pi_3_Raw/Sensor2/2017/03/Pi_3_1_2017-03-31.csv
sudo chmod ugo+rwx /home/travis/build/MatthewHeun/Data/Pi_3_Raw/Sensor3/2017/03/Pi_3_3_2017-03-31.csv
mkdir /home/travis/build/MatthewHeun/Data/Pi_3_Summary/