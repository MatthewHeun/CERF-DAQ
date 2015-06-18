#!/bin/sh

echo 'Pi_Number = '$PI_NUMBER >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo "#********************************************************************************************" >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo "#**SENSOR NAMES: used for DATA FILES and WEBSITE" >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo "#**Only change the sensor names and sensor tolerance in this file between the two starred lines" >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo "#**Example: SENSOR1: \"TNT NORTH\"" >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo "#**The name must remain in quotes!These names will be used for the DATA FILES and website" >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo "#**To save the file hit ctr-X then Y to save the file and hit enter to commit the changes" >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo "#**This file can be updated by running the pi-settings sript" >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py

echo ''>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Number_of_Temperature_and_Light_Sensors = 0  #The number of temperature and light sensors connected to the pi' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo ''>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py

echo "#**Enter sensor names here!!" >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_1 = ''"Sensor_1"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_2 = ''"Sensor_2"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_3 = ''"Sensor_3"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_4 = ''"Sensor_4"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_5 = ''"Sensor_5"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_6 = ''"Sensor_6"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_7 = ''"Sensor_7"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_8 = ''"Sensor_8"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_9 = ''"Sensor_9"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_10 = ''"Sensor_10"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_11 = ''"Sensor_11"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_12 = ''"Sensor_12"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_13 = ''"Sensor_13"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_14 = ''"Sensor_14"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_15 = ''"Sensor_15"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_16 = ''"Sensor_16"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo '' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_tol = 25   #any light reading below this value will be considered off' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'PeakTime1 = 11    #hour in a 24 hour day' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'PeakTime2 = 19    #hour in a 24 hour day' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo '' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py

echo "#**Enter sensor types here!!" >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo '# Use either "Light" or "Temperature"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_1_Type = "Light"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_2_Type = "Light"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_3_Type = "Light"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_4_Type = "Light"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_5_Type = "Light"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_6_Type = "Light"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_7_Type = "Light"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_8_Type = "Light"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_9_Type = "Light"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_10_Type = "Light"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_11_Type = "Light"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_12_Type = "Light"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_13_Type = "Light"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_14_Type = "Light"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_15_Type = "Light"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_16_Type = "Light"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo ''>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py

echo "#**Enter occupancy sensor names here!!" >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Number_of_Occupancy_Sensors = 0 #The number of occupancy sensors connected ot the pi' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_1 = "Occupancy_1"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_2 = "Occupancy_2"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_3 = "Occupancy_3"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_4 = "Occupancy_4"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_5 = "Occupancy_5"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_6 = "Occupancy_6"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_7 = "Occupancy_7"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_8 = "Occupancy_8"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_9 = "Occupancy_9"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_10 = "Occupancy_10"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_11 = "Occupancy_11"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_12 = "Occupancy_12"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_13 = "Occupancy_13"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_14 = "Occupancy_14"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_15 = "Occupancy_15"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_16 = "Occupancy_16"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py

echo '#**Enter analysis type here!!'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo '# Use either "bins", "min-max-ave", or "on/off-peak"' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo '# Type carefully and watch capitalization!' >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_1_Analysis = "bins"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_2_Analysis = "bins"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_3_Analysis = "bins"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_4_Analysis = "bins"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_5_Analysis = "bins"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_6_Analysis = "bins"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_7_Analysis = "bins"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_8_Analysis = "bins"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_9_Analysis = "bins"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_10_Analysis = "bins"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_11_Analysis = "bins"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_12_Analysis = "bins"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_13_Analysis = "bins"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_14_Analysis = "bins"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_15_Analysis = "bins"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Occupancy_16_Analysis = "bins"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_1_Analysis = "on/off-peak"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_2_Analysis = "on/off-peak"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_3_Analysis = "on/off-peak"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_4_Analysis = "on/off-peak"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_5_Analysis = "on/off-peak"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_6_Analysis = "on/off-peak"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_7_Analysis = "on/off-peak"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_8_Analysis = "on/off-peak"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_9_Analysis = "on/off-peak"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_10_Analysis = "on/off-peak"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_11_Analysis = "on/off-peak"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_12_Analysis = "on/off-peak"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_13_Analysis = "on/off-peak"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_14_Analysis = "on/off-peak"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_15_Analysis = "on/off-peak"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo 'Sensor_16_Analysis = "on/off-peak"'>> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
echo "#********************************************************************************************" >> /home/pi/Desktop/CERF-DAQ/Python/user_input.py
