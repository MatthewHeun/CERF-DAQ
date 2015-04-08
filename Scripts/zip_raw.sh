#!/bin/sh

echo "\nWelcome to the CERF Pi setup script"
echo "What number Pi is this? You will not be able to change this."
echo "This number will be used for the identification of the Pi and its data."
echo "Example: 2 (Please only enter a number)\n"
echo -n "Pi Number >"
read PI_NUMBER
echo "\nYou entered: $PI_NUMBER"
echo "If you would like to change it press 'ctr-c' right now"
sleep 2
echo "You have 5 seconds, then the script will continue"
#sleep 5
echo "Proceeding...\n"

echo "We will now update the Pi password."
echo "The default passord is 'rasberry'"
echo "Please record the new password, it will be used for SSH\n"
#passwd


echo "Creating directories"
$RawDir= "Pi_"
$RawDir+=  
echo $RawDir
mkdir $HOME/Desktop/$RawDir
#mkdir /Desktop/PI_FILES
#mkdir /Desktop/PI_FILES/Data
#mkdir /Desktop/PI_FILES/Data/Pi_ . $PI_NUMBER . _RAW
#mkdir /Desktop/PI_FILES/Data/Pi_ . $PI_NUMBER . _Summary
#mkdir /Desktop/PI_FILES/Data/Pi_ . $PI_NUMBER . _RAW/Sensor1
#mkdir /Desktop/PI_FILES/Data/Pi_ . $PI_NUMBER . _RAW/Sensor2
#mkdir /Desktop/PI_FILES/Data/Pi_ . $PI_NUMBER . _RAW/Sensor3
echo "  +Done"
echo "Set up Git Repository"

