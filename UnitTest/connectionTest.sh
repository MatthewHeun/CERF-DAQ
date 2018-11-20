#!/bin/sh

path="/home/pi/Desktop/CERF-DAQ/UnitTest/connectionList.txt"

while IFS= read -r line
do
	if ping -c 1 $line >/dev/null; then
		echo "IPv4 is up"
		else
		echo "IPv4 is down"
	fi
done <$path