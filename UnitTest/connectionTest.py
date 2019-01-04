import re
import os
import csv

EMAIL_PATH = "/home/pi/Desktop/CERF-DAQ/UnitTest/connectionTestEmails.txt"

emailFile = open(EMAIL_PATH, 'r')
ipDataList = csv.reader(open("/home/pi/Desktop/CERF-DAQ/UnitTest/connectionList.csv"))
ipDataList = list(ipDataList)

for ipData in ipDataList:
	#and then check the response...

	hostname = ipData[0].strip()
	isAdminNotified = ipData[1].strip()

	response = os.system("ping -c 1 " + hostname + " > /dev/null")

	if response == 0:
		print hostname, 'is up!'
		ipData[1] = 0
	else:
		print hostname, 'is down!'
		if ipData[1] == "0":
			for email in emailFile:
				os.system("swaks --to " + email.strip() + " -s smtp.gmail.com:587 -tls -au cerfraspberrypi@gmail.com -ap MasterCerf153$ --body 'The Pi at IP " + hostname + " is not responding!'")
			ipData[1] = "1"

writer = csv.writer(open("/home/pi/Desktop/CERF-DAQ/UnitTest/connectionList.csv", 'w'))
writer.writerows(ipDataList)
emailFile.close()
