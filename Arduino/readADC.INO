int analogPin = 34;
long int val = 0;

void setup() {
 pinMode(LED_BUILTIN, OUTPUT);
 digitalWrite( LED_BUILTIN, HIGH);
 Serial.begin(9600);

}

void loop() {
// 4095 - measured to make light meter not darkness meter
// 4095 is bytes in the ADC

 val = 4095 - analogRead(analogPin);
 Serial.println(val);
 
 // 3500 is estimated lights on threshold
 // blinks lights if above threashold
 if (val > 3500 ) {
  digitalWrite( LED_BUILTIN, LOW);
  delay(1000);
  digitalWrite( LED_BUILTIN, HIGH);
  delay(1000);
 }
 else {
 delay(1000);
  }
}
