#------------------------------------------
#--- Author: Peter Haagsma
#--- Date: April 3, 2019
#--- Python Ver: 2.7
#--- Details At: https://iotbytes.wordpress.com/store-mqtt-data-from-sensors-into-sql-database/
#------------------------------------------

import time
import paho.mqtt.client as mqtt

# Probably will use something like this -- this is probably ideal but not the way it currently works
#
#	Actual Implementation
#	passed sensor and 
#

#==================================================================
#----------------------INITIALIZE VARIABLES------------------------
#==================================================================

MQTT_Port = 1883
VALUE = 0

#==================================================================
#----------------------CALLBACK DEFINITIONS------------------------
#==================================================================

def on_connect(client, userdata, flags, rc):
	client.subscribe(userdata)

def on_message(client, userdata, msg):
	global VALUE
	VALUE = int(msg.payload)
	client.loop_stop(force=False)

#==================================================================
#------------------------CLASS DEFINITION--------------------------
#==================================================================

class MqttClient:
	def __init__(self, mqttServerAddress, sensorID, keepAlive):
		self.mqttIP = mqttServerAddress			# Address of MQTT server
		self.keepAlive = keepAlive 				# how long to try and connect
		self.topic = "/test/pjh/" + str(sensorID)
		self.Client = mqtt.Client()
		self.Client.user_data_set(self.topic)
		self.Client.on_message = on_message
		self.Client.on_connect = on_connect
		global VALUE 							# Because we have to set VALUE to global we need to ensure
		VALUE = 0								# That it will be zero any time the client is reconstructed

	def attemptConnect(self):
		self.Client.loop_start()
		self.Client.connect(self.mqttIP, int(MQTT_Port), int(self.keepAlive))
		while (VALUE == 0):
			time.sleep(0.1)
			continue

	def getValue(self):
		return VALUE
