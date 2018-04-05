#!/bin/sh
sudo /etc/init.d/cron stop 
echo 0 > /home/pi/Desktop/CERF-DAQ/WebPage/pages/dataCollectionStatus.txt

echo "Data collection is paused" 
echo "Run command sensor-edit to edit sensor names if it is needed"
echo "Run command start-pi to start data collection"

