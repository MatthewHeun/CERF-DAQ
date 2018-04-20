import unittest
import Analyze
from globalVars import *

class TestPython(unittest.TestCase):
    # Testing to see whether we can actually get to testing before failing
    def test_nothing(self):
        print("Successfully made it to testing stage! Now make some tests >:D")

    def test_globalVars(self):
        print("Testing globalVars")
        self.assertEqual(PI_NUMBER, 3, "globalVars.py incorrectly reading piNumber.txt")
        self.assertEqual(NUM_SENSORS, 3, "globalVars.py incorrectly reading numSensors.txt")
        self.assertEqual(DATA_COLLECTION_SET, 1, "globalVars.py incorrectly reading dataCollectionSet.txt")
        self.assertEqual(RESET, 0, "globalVars.py incorrectly reading reset.txt")
#        self.assertEqual(START_TIME, 0, "globalVars.py incorrectly newPeakTimes.txt")
#        self.assertEqual(START_TIME_LOW_summer, 0, "globalVars.py incorrectly newPeakTimes.txt")
#        self.assertEqual(START_TIME_MID_summer, 0, "globalVars.py incorrectly newPeakTimes.txt")
#        self.assertEqual(START_TIME_HIGH_summer, 0, "globalVars.py incorrectly newPeakTimes.txt")
#        self.assertEqual(STOP_TIME_HIGH_summer, 0, "globalVars.py incorrectly newPeakTimes.txt")
#        self.assertEqual(STOP_TIME_MID_summer, 0, "globalVars.py incorrectly newPeakTimes.txt")
#        self.assertEqual(STOP_TIME_LOW_summer, 0, "globalVars.py incorrectly newPeakTimes.txt")
#        self.assertEqual(START_TIME_MID_winter, 0, "globalVars.py incorrectly newPeakTimes.txt")
#        self.assertEqual(START_TIME_HIGH_winter, 0, "globalVars.py incorrectly newPeakTimes.txt")
#        self.assertEqual(STOP_TIME_HIGH_winter, 0, "globalVars.py incorrectly newPeakTimes.txt")
#        self.assertEqual(STOP_TIME_MID_winter, 0, "globalVars.py incorrectly newPeakTimes.txt")
#        self.assertEqual(STOP_TIME, 0, "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].name, "Light1", "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].type, "Light", "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].i2cAddress, "0x49", "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].pinNumber, 1, "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].numberOfAnalysis, 3, "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].wattage, "", "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].analysis[0], "Range Analysis", "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].analysis[1], "On-Peak Off-Peak %", "globalVars.py incorrectly newPeakTimes.txt")
        self.assertEqual(SENSOR_INFO[0].analysis[2], "Min-Max", "globalVars.py incorrectly newPeakTimes.txt")
        print("Passed!")

    def test_analyze(self):
        print("Testing analyze")
        
        print("Passed!")

if __name__ == '__main__':
    unittest.main()