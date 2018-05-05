import unittest
import os
cwd = os.getcwd()
amTestFile = cwd + "/UnitTest/amTest.txt"
f = open(amTestFile, "w")
f.write("1")
f.close()

import Analyze
from globalVars import *

class TestPython(unittest.TestCase):
    # Testing to see whether we can actually get to testing before failing
    def test_nothing(self):
        self.assertEqual(0,0)
    
    def test_globalVars(self):
        self.assertEqual(PI_NUMBER, 3, "globalVars.py incorrectly reading piNumber.txt")
        self.assertEqual(NUM_SENSORS, 3, "globalVars.py incorrectly reading numSensors.txt")
        self.assertEqual(DATA_COLLECTION_SET, 1, "globalVars.py incorrectly reading dataCollectionSet.txt")
        self.assertEqual(RESET, 0, "globalVars.py incorrectly reading reset.txt")
        self.assertEqual(START_TIME, 0, "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(START_TIME_LOW_summer, 6, "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(START_TIME_MID_summer, 12, "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(START_TIME_HIGH_summer, 14, "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(STOP_TIME_HIGH_summer, 17, "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(STOP_TIME_MID_summer, 19, "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(STOP_TIME_LOW_summer, 23, "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(START_TIME_MID_winter, 14, "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(START_TIME_HIGH_winter, 16, "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(STOP_TIME_HIGH_winter, 19, "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(STOP_TIME_MID_winter, 21, "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(STOP_TIME, 23, "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].name, "Light1", "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].type, "Light", "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].i2cAddress, "0x49", "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].pinNumber, "1", "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].numberOfAnalysis, "3", "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].wattage, "", "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].analysis[0], "Range Analysis", "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].analysis[1], "On-Peak Off-Peak %", "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].analysis[2], "Min-Max", "globalVars.py incorrectly newPeakTimes.txt")

    def test_analyze(self):
        self.assertEqual(0,0)
        currentWorkingDirectory = os.getcwd()
        dataDirectory = currentWorkingDirectory[:(len(currentWorkingDirectory) - 8)] + "Data/"
        summaryfile = open(dataDirectory + "Pi_3_Summary/Pi_3_1a1.csv", 'r')

        for line in summaryFile:
            if line[0].isdigit():
                row = re.split(',', line)
                





# This method is just a safety mechanism in case TestPython is run on a Raspberry Pi
# Running this ensures that the sensor class knows it's in normal mode, not test mode
#
#   def test_amTest(self):
#       f = open(amTestFile, "w")
#       f.write("0")
#       f.close()

if __name__ == '__main__':
    unittest.main()
