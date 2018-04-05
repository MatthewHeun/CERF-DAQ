#!/bin/sh

python /home/pi/Desktop/CERF-DAQ/Python/GetData.py
python /home/pi/Desktop/CERF-DAQ/Python/GPIO_Occupancy.py

sudo chmod ugo+rwx /home/pi/Desktop/Data -R
sudo chmod ugo+rwx /home/pi/Desktop/CERF-DAQ/WebPage/pages -R