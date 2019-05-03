int analogPin = 34;
long int val = 0;

void setup() {
 pinMode(LED_BUILTIN, OUTPUT);
 pinMode(15, OUTPUT);
 digitalWrite( LED_BUILTIN, HIGH);
 digitalWrite(15, HIGH);
 Serial.begin(9600);
 // delay due to tutorial noting issue of ESP32 not waking up
 delay(500);
 // 4095 - measured to make light meter not darkness meter
// 4095 is bytes in the ADC

 val = 4095 - analogRead(analogPin);
 Serial.println(val);
  digitalWrite(15, LOW);
 
 // 3500 is estimated lights on threshold
 // blinks lights if above threashold
 if (val > 3500 ) {
  digitalWrite( LED_BUILTIN, LOW);
  delay(1000);
  digitalWrite( LED_BUILTIN, HIGH);
  delay(500);
 }
 else {
 delay(500);
   }
 // number of microseconds to sleep
 esp_sleep_enable_timer_wakeup(60000000);
 esp_deep_sleep_start();
 }

void loop() {
// loop does not run when using deep sleep!
  }
}
