#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>

#define SS_PIN 2
#define RST_PIN 4

#define ERROR_PIN 16
#define SUCCESS_PIN 5



const char *ssid = "Nigga get yo own WiFi"; 
const char *password = "putinpeder";

MFRC522 mfrc522(SS_PIN, RST_PIN);
void setup() {
   delay(1000);
   Serial.begin(9600);
   WiFi.mode(WIFI_OFF);    
   delay(1000);
   WiFi.mode(WIFI_STA);
   WiFi.begin(ssid, password);
   Serial.println("");

   pinMode(SUCCESS_PIN, OUTPUT);
   pinMode(ERROR_PIN, OUTPUT);
   
   Serial.print("Connecting");
   while (WiFi.status() != WL_CONNECTED) {
     delay(500);
     Serial.print(".");
   }

   Serial.println("");
   Serial.print("Connected to ");
   Serial.println(ssid);
   Serial.print("IP address: ");
   Serial.println(WiFi.localIP()); 
   
   SPI.begin();
   mfrc522.PCD_Init();
}

void sendRfidLog(long cardId) {
  
  if(WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    String postData = "reg=A00-A-001&card=" + String(cardId);
    
    Serial.println("KarticaID:");
    Serial.println(String(cardId));
     
    http.begin("http://192.168.0.16/publictransportcloud/api/LinijaPlacanje/card.php");   
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");  

    Serial.println(postData);
    int httpCode = http.POST(postData); 
    String payload = http.getString();

    Serial.println("httpCode:");
    Serial.println(httpCode);

    Serial.println("payload:");
    Serial.println(payload);
    
    if(payload.equals("success")) {
     digitalWrite(SUCCESS_PIN, HIGH);
     Serial.println("success! uspjelo je");
    } else {
     digitalWrite(ERROR_PIN, HIGH);
     Serial.println("Nece!");
    }
    
    http.end();
  }
}


void loop() {

  if ( mfrc522.PICC_IsNewCardPresent()){
    if ( mfrc522.PICC_ReadCardSerial()){
      long code=0;
      for (byte i = 0; i < mfrc522.uid.size; i++){
        code=((code+mfrc522.uid.uidByte[i])*10);
      }
      sendRfidLog(code);
    }
  }
  
  delay (2000);
  
  digitalWrite(SUCCESS_PIN, LOW);
  digitalWrite(ERROR_PIN, LOW);
     
}
