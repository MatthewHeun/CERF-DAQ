#!/bin/sh
sudo rm -r /home/pi/Desktop/Data
echo "Data files are deleted"
sudo /etc/init.d/cron stop 
echo "Data collection is paused" 
#===============================
#==========Pi Number============
#===============================
echo "\nWelcome to the CERF Pi Reset script"
echo "What number Pi is this?"
echo "Example: 2 (Please only enter a number)\n"
echo -n "Pi Number >"
read PI_NUMBER
echo "\nYou entered: $PI_NUMBER"
read -p "Would you like to continue?(y/n): " REPLY
if [ "$REPLY" != "y" ]; then
	exit
fi
echo
echo "Proceeding...\n"
#===============================
#=====CHANGING HOSTNAME=========
#===============================
echo "Changing Hostname..."
sudo hostname cerfpi$PI_NUMBER


sudo rm /home/pi/Desktop/CERF-DAQ/WebPage/pages/Raw.zip
sudo rm /home/pi/Desktop/CERF-DAQ/WebPage/pages/Summary.zip
#==================================
#====Creating Global Vars PHP =====
#==================================
cd /home/pi/Desktop/CERF-DAQ/WebPage/pages/
echo "Run command sensor-edit to edit sensor names"
echo "Run command start-pi to start data collection"

