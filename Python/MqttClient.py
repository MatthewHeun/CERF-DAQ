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

VALUE = -2
E_TIME = 0

DATA_FLAG = False
TIME_FLAG = False
#==================================================================
#----------------------CALLBACK DEFINITIONS------------------------
#==================================================================

def on_connect(client, userdata, flags, rc):
	client.subscribe(userdata[0])
	client.subscribe(userdata[1])
	print(userdata)
	print("Subscribed")

def on_message(client, userdata, msg):
	global VALUE
	global DATA_FLAG
	global E_TIME
	print(msg.payload)
	if msg.topic == userdata[0]:
		DATA_FLAG = True
		try:
			VALUE = int(msg.payload)
		except:
			VALUE = -1
	elif msg.topic == userdata[1]:
		TIME_FLAG = True
		print("TIME RECIEVED")
		print(msg.payload)
		try:
			E_TIME = int(msg.payload)
		except:
			E_TIME = -1
	if DATA_FLAG and TIME_FLAG:
		TIME_FLAG = False
		DATA_FLAG = False
		client.loop_stop(force=False)

#==================================================================
#------------------------CLASS DEFINITION--------------------------
#==================================================================

class MqttClient:
	def __init__(self, mqttServerAddress, sensorID, keepAlive):
		self.mqttIP = mqttServerAddress			# Address of MQTT server
		self.keepAlive = keepAlive 				# how long to try and connect
		self.topic = "/" + str(sensorID)
		self.timetopic = "/time" + self.topic
		self.Client = mqtt.Client()
		self.Client.user_data_set([self.topic, self.timetopic])
		self.Client.on_message = on_message
		self.Client.on_connect = on_connect
		global VALUE 							# Because we have to set VALUE to global we need to ensure
		VALUE = -2								# That it will be zero any time the client is reconstructed

	def attemptConnect(self):
		self.Client.loop_start()
		self.Client.connect(self.mqttIP, int(MQTT_Port), int(self.keepAlive))
		global VALUE
		count = 0
		for i in range(200):
			print(i)
			time.sleep(0.1)
			if (VALUE != -2):
				break
			continue
		self.Client.loop_stop()


	def getValue(self):
		global VALUE
		global E_TIME
		return [VALUE, E_TIME]
