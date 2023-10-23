#include <WiFi.h>
#include <PubSubClient.h>
#include <ArduinoJson.h>
#include "Ultrasonic.h"
#include <DallasTemperature.h>  
#include <OneWire.h>


// WiFi Credentials
const char* ssid = "Muelltonne";
const char* password = "Muelltonne123";

// MQTT Broker Credentials
const char* mqtt_server = "192.168.0.100";
const int mqtt_port = 1883; // MQTT non-secure

// MQTT Topic and Message
const char* mqtt_topic = "data";

WiFiClient wifiClient;
PubSubClient client(wifiClient);

// Sensor Data


//Variables for data
int muell_id = 1;
int sensorwert;                      
bool MagneticStatus;                
bool BrandStatus;
int TonnenStatus;
long RangeInCentimeters;
double Temperatur;
float tempCelsius;


// Auxiliar variables to store the current output state
//String output26State = "off";
//String output27State = "off";

// Assign output variables to GPIO pins
//const int output26 = 26;
//const int output27 = 27;
const int PIN34 = 34;
#define MAGNECTIC_SWITCH 19
#define KY001_Signal_PIN 18
Ultrasonic ultrasonic(5);      // Zahl ist PIN achten dass keine Doppelbelegung!!
#define FLAME_SENSOR 4 //connect SENSOR to digital pin32


//Bibs Konfigurieren
OneWire oneWire(KY001_Signal_PIN);          
DallasTemperature sensors(&oneWire);



//const long intervall = 5 * 1000;
const long intervall = 30 * 60 ;
long lastPublishTime = 0 ;

void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("WiFi connected");
  
  // Set MQTT Broker server and port
  client.setServer(mqtt_server, mqtt_port);
  
  // Connect to MQTT Broker
  while (!client.connected()) {
    Serial.println("Connecting to MQTT Broker...");
    if (client.connect("ESP32_Client")) {
      Serial.println("Connected to MQTT Broker");
    } else {
      Serial.print("Failed with state ");
      Serial.print(client.state());
      delay(2000);
    }
  }
  // Initialize the output variables as outputs
  //pinMode(output26, OUTPUT);
 // pinMode(output27, OUTPUT);
  pinMode(PIN34, INPUT);
  // Set outputs to LOW
  //digitalWrite(output26, LOW);
  //digitalWrite(output27, LOW);
   sensors.begin();
   

}

void loop(){
  
Serial.println(millis());
  //Werte einlesen
  TouchTest();
  BrandTest();
  MagneticSwitch();
  UltraSonic();
  TempMessung();

  // Wer hat an der Uhr gedreht? Ist es wirklich schon so spät? 
  
  if (millis() - lastPublishTime > intervall) 
  {
    
    lastPublishTime = millis();
    // JSON document erstellen
    StaticJsonDocument<200> jsonDoc;
    jsonDoc["bin_id"] = muell_id;
    jsonDoc["temperature"] = tempCelsius;
    jsonDoc["fill_level"] = TonnenStatus;
    jsonDoc["burns"] = BrandStatus;
    jsonDoc["lid_open"] = MagneticStatus;

    //  JSON document-->string
    String jsonString;
    serializeJson(jsonDoc, jsonString);

    //  JSON --> MQTT Broker
    client.publish(mqtt_topic, jsonString.c_str());
    Serial.println("published to MQTT Broker");
  }
  client.loop();
  
}



void TouchTest(){
  
  sensorwert=digitalRead(PIN34);     
  
}


void MagneticSwitch(){

  if(digitalRead(MAGNECTIC_SWITCH) == HIGH)//if the sensor value is HIGH?
    {
        MagneticStatus = false;
    }
    else
    {
       MagneticStatus = true;
    }
//    Serial.println(MagneticStatus);
    //delay(300);
}

void BrandTest(){
  
  if((digitalRead(FLAME_SENSOR)==1))
    {
       BrandStatus = false;
    }
    else
    {
       BrandStatus = true;
    }
//    Serial.println(BrandStatus);
   //delay(200);
}

void UltraSonic(){

   //long RangeInCentimeters;
  float temp = 0;
  int tempint = 0;
    //Serial.println("The distance to obstacles in front is: ");
    RangeInCentimeters = ultrasonic.MeasureInCentimeters(); // two measurements should keep an interval
   temp =  (100 - (float)RangeInCentimeters * 1.15) ;
   // Der Sensor is ungenau so passt der immerhin etwas
   if (temp < 20)
   {
    tempint = 0;
   }
   else if(temp > 20 && temp < 50)
   {
    tempint = 25;
    }
   else if(temp > 50 && temp < 75)
   {
    tempint = 50;
    }
   else if(temp > 75 && temp < 85)
   {
    tempint = 75;
    }
   else
   {
    tempint = 100;
    }
   
    TonnenStatus = tempint;
//    Serial.println(tempint);
//    if(RangeInCentimeters < 20){
//    }
//    else if(20 < RangeInCentimeters && RangeInCentimeters < 50){
//      TonnenStatus = " Tonne ist halbvoll!";
//    }
//    else {
//      TonnenStatus = " Tonne ist leer!";
//    }
    
    
    
    //Serial.print(RangeInCentimeters);//0~400cm
    //Serial.println(" cm");
    //delay(250);
}

void TempMessung(){
 // Temperaturmessung wird gestartet...
   sensors.requestTemperatures();
    // ... und gemessene Temperatur ausgeben
   // Serial.print("Temperature: ");
   
   tempCelsius = sensors.getTempCByIndex(0);
//    Serial.println(tempCelsius);
   // delay(1000); // 1s Pause bis zur nächsten Messung  
}
