#==================================================================
#-----------------------------IMPORTS------------------------------
#==================================================================
import datetime


#==================================================================
#------------------------CLASS DEFINITION--------------------------
#==================================================================

class Bins:
	def __init__(self, sensorNumber):
		self.timeArray = []

	def addBin(self, startTime, stopTime):
		startTime = datetime.datetime.strptime(startTime, "%Y-%m-%d %H:%M:%S")
		stopTime = datetime.datetime.strptime(stopTime, "%Y-%m-%d %H:%M:%S")
		self.timeArray.append([startTime, stopTime])
		# print self.timeArray

	def addStartTime(self, startTime):
		startTime = datetime.datetime.strptime(startTime, "%Y-%m-%d %H:%M:%S")
		self.timeArray.append([startTime, ""])
		# print self.timeArray

	def addStopTime(self, stopTime):
		stopTime = datetime.datetime.strptime(stopTime, "%Y-%m-%d %H:%M:%S")
		index = len(self.timeArray)-1
		self.timeArray[index][1] = stopTime
		# print self.timeArray