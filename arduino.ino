#include <PulseSensorPlayground.h>      
const int PulseWire = 5;       
const int GSR = 4; 
int Threshold = 550;                                                               
PulseSensorPlayground pulseSensor;  
void setup() {   
  Serial.begin(9600);          // For Serial Monitor
  pulseSensor.analogInput(PulseWire);   
   if (pulseSensor.begin()) {    }
}
void loop() {
int sum=0;
int sumBPM=0;
int j=0;
int bpm_average=0;
int sensorValue=0;
int gsr_average=0;

  if (pulseSensor.sawStartOfBeat()) {
    int myBPM = pulseSensor.getBeatsPerMinute();
    delay(1000);
    for(int i=0;i<10;i++)           //Average the 10 measurements to remove the glitch
        {
        sensorValue=analogRead(GSR);
        sum += sensorValue;
        delay(200);
        }
    gsr_average = sum/10;
    Serial.print("G"); // Send the identifier
    Serial.print(":");
    Serial.println(gsr_average);
    Serial.print("P"); // Send the identifier
    Serial.print(":");
    Serial.println(myBPM);
  }
}
