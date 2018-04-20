import unittest
import Analyze
import globalVars

class TestPython(unittest.TestCase):
    # Testing to see whether we can actually get to testing before failing
    def test_nothing(self):
        print("Successfully made it to testing stage! Now make some tests >:D")
        pass

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
        self.assertEqual(SENSOR_INFO[0].name, "Light1", msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
#        self.assertEqual(first, second, msg)
        pass

if __name__ == '__main__':
    unittest.main()