from user_input import* # import the user input for sensor-data

#==================================================================
#----------------------INITIALIZE VARIABLES------------------------
#==================================================================

sensorTypeTempAndLight = [Sensor_1_Type, Sensor_2_Type, Sensor_3_Type, Sensor_4_Type, Sensor_5_Type, Sensor_6_Type, Sensor_7_Type, Sensor_8_Type, Sensor_9_Type, Sensor_10_Type, Sensor_11_Type, Sensor_12_Type, Sensor_13_Type, Sensor_14_Type, Sensor_15_Type, Sensor_16_Type]
temperatureAndLightNames = [Sensor_1, Sensor_2, Sensor_3, Sensor_4, Sensor_5, Sensor_6, Sensor_7, Sensor_8, Sensor_9, Sensor_10, Sensor_11, Sensor_12, Sensor_13, Sensor_14, Sensor_15, Sensor_16]
occupancyNames = [Occupancy_1, Occupancy_2, Occupancy_3, Occupancy_4, Occupancy_5, Occupancy_6, Occupancy_7, Occupancy_8, Occupancy_9, Occupancy_10, Occupancy_11, Occupancy_12, Occupancy_13, Occupancy_14, Occupancy_15, Occupancy_16]
numberOfSensors = Number_of_Temperature_and_Light_Sensors + Number_of_Occupancy_Sensors
sensorAnalysis = [Sensor_1_Analysis, Sensor_2_Analysis, Sensor_3_Analysis, Sensor_4_Analysis, Sensor_5_Analysis, Sensor_6_Analysis, Sensor_7_Analysis, Sensor_8_Analysis, Sensor_9_Analysis, Sensor_10_Analysis, Sensor_11_Analysis, Sensor_12_Analysis, Sensor_13_Analysis, Sensor_14_Analysis, Sensor_15_Analysis, Sensor_16_Analysis]
occupancyAnalysis = [Occupancy_1_Analysis, Occupancy_2_Analysis, Occupancy_3_Analysis, Occupancy_4_Analysis, Occupancy_5_Analysis, Occupancy_6_Analysis, Occupancy_7_Analysis, Occupancy_8_Analysis, Occupancy_9_Analysis, Occupancy_10_Analysis, Occupancy_11_Analysis, Occupancy_12_Analysis, Occupancy_13_Analysis, Occupancy_14_Analysis, Occupancy_15_Analysis, Occupancy_16_Analysis]

#==================================================================
#------------------------GLOBAL VARIABLES--------------------------
#==================================================================

##### Variables meant to be used outside of the scope of this file are defined in ALL CAPS

PI_NUMBER = Pi_Number
TOTAL_SENSORS = Number_of_Temperature_and_Light_Sensors + Number_of_Occupancy_Sensors
NUM_TEMP_AND_LIGHT = Number_of_Temperature_and_Light_Sensors
NUM_OCCUPANCY = Number_of_Occupancy_Sensors

SENSOR_TOL = Sensor_tol
PEAK_TIME1 = PeakTime1
PEAK_TIME2 = PeakTime2


SENSOR_NAMES = [""] * TOTAL_SENSORS
SENSOR_TYPES = [""] * TOTAL_SENSORS
ANALYSIS_TYPES = [""] * TOTAL_SENSORS

##### Populate sensor data
for i in range(Number_of_Temperature_and_Light_Sensors):
	SENSOR_NAMES[i] = temperatureAndLightNames[i]
for i in range(Number_of_Occupancy_Sensors):
	SENSOR_NAMES[i + Number_of_Temperature_and_Light_Sensors] = occupancyNames[i]

for i in range(Number_of_Temperature_and_Light_Sensors):
	SENSOR_TYPES[i] = sensorTypeTempAndLight[i]
for i in range(Number_of_Occupancy_Sensors):
	SENSOR_TYPES[i+Number_of_Temperature_and_Light_Sensors] = "Occupancy"

for i in range(Number_of_Temperature_and_Light_Sensors):
	ANALYSIS_TYPES[i] = sensorAnalysis[i]
for i in range(Number_of_Occupancy_Sensors):
	ANALYSIS_TYPES[i+Number_of_Temperature_and_Light_Sensors] = occupancyAnalysis[i-Number_of_Temperature_and_Light_Sensors]

