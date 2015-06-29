class Sensor:
	def __init__(self, sensorNumber):
		self.name = ""
		self.type = ""
		self.analysis = ""
		self.peakStart = 0
		self.peakStop = 0
		self.thresholdMin = 0
		self.thresholdMax = 0
		self.number = sensorNumber

	def set_name(self, new_name):
		self.name = new_name

	def set_type(self, new_type):
		self.type = new_type

	def set_analysis(self, new_analysis):
		self.analysis = new_analysis

	def set_peak(self, new_peak_start, new_peak_stop):
		self.peakStart = new_peak_start
		self.peakStop = new_peak_stop

	def set_threshold(self, new_threshold_min, new_threshold_max):
		self.thresholdMin = new_threshold_min
		self.thresholdMax = new_threshold_max
