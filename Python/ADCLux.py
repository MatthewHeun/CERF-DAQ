import time
from Adafruit_ADS1x15 import ADS1x15

ADS1115 = 0x01	# 16-bit ADC

# Initialise the ADC using the default mode (use default I2C address)
# Set this to ADS1015 or ADS1115 depending on the ADC you are using!
adc = ADS1x15(ic=ADS1115)

# Read channel 0 in single-ended mode, +/-4.096V, 250sps

while 1:
	volts0 = adc.readADCSingleEnded(0, 4096, 250) / 1000
	volts1 = adc.readADCSingleEnded(1, 4096, 250) / 1000
	volts2 = adc.readADCSingleEnded(2, 4096, 250) / 1000
	
	lux0 = pow(10, volts0)
	lux1 = pow(10, volts1)
	lux2 = pow(10, volts2)
	print "0:  " + "%.6f" % (lux0) + "    %.6f" % (volts0)
	print "1:  " + "%.6f" % (lux1) + "    %.6f" % (volts1)
	print "2:  " + "%.6f" % (lux2) + "    %.6f" % (volts2)
	time.sleep(1)