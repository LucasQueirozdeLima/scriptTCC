#if defined(ESP32)
#include <WiFi.h>
#elif defined(ESP8266)
#include <ESP8266WiFi.h>
#endif
#include <WiFiManager.h> // Biblioteca do WiFiManager
#include <Firebase_ESP_Client.h>
#include <SPI.h>
#include <MFRC522.h>
#include <addons/TokenHelper.h>
#include <time.h>

// Definindo os pinos do MFRC522
#define SS_PIN 5
#define RST_PIN 17

MFRC522 mfrc522(SS_PIN, RST_PIN);  // Criar instância do MFRC522

// Define Firebase API Key, Project ID, e credenciais de usuário
#define API_KEY "AIzaSyBgaDoODNN_5DAor-R5yORD27MIUM0JAPI"
#define FIREBASE_PROJECT_ID "academia-vini"
#define USER_EMAIL "b.rafaelgon@outlook.com"
#define USER_PASSWORD "bruno123"

// Objetos Firebase
FirebaseData fbdo;
FirebaseAuth auth;
FirebaseConfig config;

void setup() {
 // Inicializa comunicação serial para depuração
  Serial.begin(115200);

  SPI.begin();  // Iniciar o SPI
  mfrc522.PCD_Init();  // Iniciar o MFRC522

  // Inicializa WiFiManager
  WiFiManager wifiManager;
  wifiManager.setTimeout(180); // Tempo limite de 3 minutos para configuração do Wi-Fi

  // Tenta conectar ao Wi-Fi salvo ou inicia AP para configuração
  if (!wifiManager.autoConnect("ConfigWiFi-AP")) {
    Serial.println("Falha na conexão ou tempo limite atingido. Reiniciando...");
    ESP.restart(); // Reinicia caso falhe ou não configure o Wi-Fi
  }
  
  Serial.println("Conectado ao Wi-Fi!");
  Serial.print("IP: ");
  Serial.println(WiFi.localIP());

  // Imprime a versão do cliente Firebase
  Serial.printf("Firebase Client v%s\n\n", FIREBASE_CLIENT_VERSION);

  // Configura a autenticação do Firebase
  config.api_key = API_KEY;
  auth.user.email = USER_EMAIL;
  auth.user.password = USER_PASSWORD;

  // Define callback para o status do token
  config.token_status_callback = tokenStatusCallback;

  // Inicializa Firebase
  Firebase.begin(&config, &auth);

  // Reativa Wi-Fi automaticamente se a conexão for perdida
  Firebase.reconnectWiFi(true);

  // Inicializa o gerador de números aleatórios
  randomSeed(analogRead(0));
}

void loop() {
  // Verificar se há um cartão presente
  if (mfrc522.PICC_IsNewCardPresent()) {
    if (mfrc522.PICC_ReadCardSerial()) {
      String uid = getCardUID();
      Serial.print("UID do Cartão: ");
      Serial.println(uid);
      updatePessoaPresente();  // Atualizar a presença no Firebase
    }
  }
}

String getCardUID() {
  String uid = "";
  for (byte i = 0; i < mfrc522.uid.size; i++) {
    uid += String(mfrc522.uid.uidByte[i] < 0x10 ? "0" : "");
    uid += String(mfrc522.uid.uidByte[i], HEX);
  }
  return uid;
}

int getPessoas() {
  // Caminho do documento no Firestore
  String documentPath = "ACADEMIAS/2";

  // Faz a requisição para obter o documento do Firestore
  if (Firebase.Firestore.getDocument(&fbdo, FIREBASE_PROJECT_ID, "", documentPath.c_str())) {
    Serial.printf("Documento obtido com sucesso\n%s\n\n", fbdo.payload().c_str());

    // Obtemos os dados JSON do documento retornado
    FirebaseJson json = fbdo.jsonData(); // Obtemos o JSON retornado
    int pessoasPresente = 0;

    // Acessando o campo 'pessoaPresente/integerValue' no JSON
    FirebaseJsonData fieldData;
    if (json.get("fields/pessoaPresente/integerValue", fieldData)) {
      pessoasPresente = fieldData.intValue;
      Serial.printf("Número de pessoas presentes: %d\n", pessoasPresente);
      return pessoasPresente;  // Retorna o valor obtido
    } else {
      Serial.println("Erro ao acessar o campo 'pessoaPresente/integerValue'");
      return -1;  // Retorna -1 caso não consiga encontrar o valor
    }

  } else {
    // Caso haja erro na requisição ao Firestore
    Serial.println("Erro ao obter o documento:");
    Serial.println(fbdo.errorReason());
    return -1;  // Retorna -1 em caso de erro
  }
}

void updatePessoaPresente() {
  // Gera um número aleatório (exemplo: entre 1 e 100)
  int randomValue = getPessoas();

  // Caminho do documento a ser atualizado
  String academiaDocPath = "ACADEMIAS/2";

  // Cria um objeto FirebaseJson para o campo pessoaPresente
  FirebaseJson updateContent;
  updateContent.set("fields/pessoaPresente/integerValue", randomValue);

  // Atualiza o campo pessoaPresente no documento
  if (Firebase.Firestore.patchDocument(&fbdo, FIREBASE_PROJECT_ID, "", academiaDocPath.c_str(), updateContent.raw(), "pessoaPresente")) {
    Serial.printf("Campo pessoaPresente atualizado para: %d\n", randomValue);
  } else {
    Serial.printf("Falha ao atualizar pessoaPresente: %s\n", fbdo.errorReason().c_str());
  }
}
