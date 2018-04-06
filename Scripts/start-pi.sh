#!/bin/sh
sudo /etc/init.d/cron restart
echo 1 > /home/pi/Desktop/CERF-DAQ/WebPage/pages/dataCollectionStatus.txt
