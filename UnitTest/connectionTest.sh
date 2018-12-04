#!/bin/sh

path="/home/pi/Desktop/CERF-DAQ/UnitTest/connectionList.txt"

while IFS= read -r line
do
	if  ! ping -c 1 $line >/dev/null; then
		swaks --to pjh26@students.calvin.edu -s smtp.gmail.com:587 -tls -au cerfraspberrypi@gmail.com -ap MasterCerf153$ --body "The Pi at IP $line is not responding!!"
	else
		echo "Success!"
	fi
done <$path