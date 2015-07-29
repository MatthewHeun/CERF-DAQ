#! /bin/sh -e

echo '0' > "/home/pi/Desktop/CERF-DAQ/WebPage/pages/updateHealth.txt"

yes | sudo apt-get update
yes | sudo apt-get upgrade

echo '1' > "/home/pi/Desktop/CERF-DAQ/WebPage/pages/updateHealth.txt"