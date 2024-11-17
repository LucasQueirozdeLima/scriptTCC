#include <SPI.h>
#include <MFRC522.h>

#define SS_PIN 5
#define RST_PIN 22

MFRC522 mfrc522(SS_PIN, RST_PIN); // Instância do MFRC522

void setup() {
  Serial.begin(115200);  // Inicializa o monitor serial
  SPI.begin();           // Inicia o barramento SPI
  mfrc522.PCD_Init();    // Inicializa o MFRC522
}

void loop() {
  // Verifica se há uma tag presente
  if (mfrc522.PICC_IsNewCardPresent()) {
    // Lê o ID da tag
    if (mfrc522.PICC_ReadCardSerial()) {
      String tagID = "";
      for (byte i = 0; i < mfrc522.uid.size; i++) {
        tagID += String(mfrc522.uid.uidByte[i], HEX);
      }

      // Envia o ID da tag via Serial para o ESP32
      Serial.println(tagID);  // Envia o ID da tag para o ESP32
      delay(2000);  // Atraso de 2 segundos antes de ler outra tag
    }
  }
}
