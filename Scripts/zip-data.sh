#!/bin/sh -e

echo '0' > "/home/pi/Desktop/CERF-DAQ/WebPage/pages/zipHealth.txt"

PI_NUMBER=$(cat /home/pi/Desktop/CERF-DAQ/WebPage/pages/piNumber.txt)
echo "$PI_NUMBER"

Raw="/home/pi/Desktop/CERF-DAQ/WebPage/pages/Raw.zip /home/pi/Desktop/Data/Pi_"$PI_NUMBER"_Raw/"
Summary="/home/pi/Desktop/CERF-DAQ/WebPage/pages/Summary.zip /home/pi/Desktop/Data/Pi_"$PI_NUMBER"_Summary/"

echo $Raw
echo $Summary

zip -r -j $Raw
zip -r -j $Summary

echo '0' > "/home/pi/Desktop/CERF-DAQ/WebPage/pages/zipStatus.txt"

echo '1' > "/home/pi/Desktop/CERF-DAQ/WebPage/pages/zipHealth.txt"