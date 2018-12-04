#!/bin/sh

connectionList="/home/pi/Desktop/CERF-DAQ/UnitTest/connectionList.txt"
emailList="/home/pi/Desktop/CERF-DAQ/UnitTest/connectionTestEmails.txt"

while IFS= read -r line
do
	if  ! ping -c 1 $line >/dev/null; then
		while read email
		do
			swaks --to $email -s smtp.gmail.com:587 -tls -au cerfraspberrypi@gmail.com -ap MasterCerf153$ --body "The Pi at IP $line is not responding!!"
		done < $emailList
	else
		echo "Success!"
	fi
done < $connectionList