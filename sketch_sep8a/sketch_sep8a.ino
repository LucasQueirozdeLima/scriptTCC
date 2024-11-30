#if defined(ESP32)
#include <WiFi.h>
#elif defined(ESP8266)
#include <ESP8266WiFi.h>
#endif
#include <WiFiManager.h>  // Biblioteca do WiFiManager
#include <Firebase_ESP_Client.h>
#include <SPI.h>
#include <MFRC522.h>
#include <addons/TokenHelper.h>
#include <time.h>
#include <ArduinoJson.h>

// Definindo os pinos do MFRC522
#define SS_PIN 5
#define RST_PIN 17

MFRC522 mfrc522(SS_PIN, RST_PIN);  // Criar instância do MFRC522

// Define Firebase API Key, Project ID, e credenciais de usuário
#define API_KEY "AIzaSyDBdSRyaboQFVLZslagd8IeD197Ce05ZoM"
#define FIREBASE_PROJECT_ID "grafico-93b0a"
#define USER_EMAIL "b.rafaelgon@outlook.com"
#define USER_PASSWORD "bruno123"

// Objetos Firebase
FirebaseData fbdo;
FirebaseAuth auth;
FirebaseConfig config;

// Defina o fuso horário
const char *ntpServer = "pool.ntp.org"; // servidor NTP público
const long gmtOffset_sec = -10800; // Offset para o Brasil (GMT-3)
const int daylightOffset_sec = 0; // Desconsiderando horário de verão
int maxAlcancado = 0;

void setup() {
  // Inicializa comunicação serial para depuração
  Serial.begin(115200);

  SPI.begin();  // Iniciar o SPI
  mfrc522.PCD_Init();  // Iniciar o MFRC522

  // Inicializa WiFiManager
  WiFiManager wifiManager;
  wifiManager.setTimeout(180);  // Tempo limite de 3 minutos para configuração do Wi-Fi

  // Tenta conectar ao Wi-Fi salvo ou inicia AP para configuração
  if (!wifiManager.autoConnect("ConfigWiFi-AP")) {
    Serial.println("Falha na conexão ou tempo limite atingido. Reiniciando...");
    ESP.restart();  // Reinicia caso falhe ou não configure o Wi-Fi
  }

  Serial.println("Conectado ao Wi-Fi!");
  Serial.print("IP: ");
  Serial.println(WiFi.localIP());

 // Configura o NTP
  configTime(gmtOffset_sec, daylightOffset_sec, ntpServer);

  // Sincronizar hora
  Serial.println("Sincronizando com o NTP...");
  while (!time(nullptr)) {
    Serial.print(".");
    delay(1000);
  }
  Serial.println("\nHora sincronizada!");

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


int getPessoas() {
 String path = "ACADEMIAS/2";  // Caminho para o documento específico

  Serial.print("Entrando no documento: ");
  Serial.println(path);

  if (Firebase.Firestore.getDocument(&fbdo, FIREBASE_PROJECT_ID, "", path.c_str(), ""))
  {
    Serial.print("Documento encontrado! ");

    // Parse do JSON
    StaticJsonDocument<1024> doc;
    DeserializationError error = deserializeJson(doc, fbdo.payload().c_str());

    if (!error)
    {
      // Acessa o valor do campo pessoaPresente
      int stateValue = doc["fields"]["pessoaPresente"]["integerValue"];

      Serial.print("pessoaPresente: ");
      return stateValue;  // Retorna o valor do campo pessoaPresente
    }
    else
    {
      Serial.println("Erro ao desserializar JSON");
    }
  }
  else
  {
    Serial.println("Erro ao acessar o documento.");
  }

  return -1;  // Retorna -1 em caso de erro
}

String getRFC3339Timestamp() {
  struct tm timeinfo;
  if (!getLocalTime(&timeinfo)) {
    Serial.println("Erro ao obter hora local");
    return "";
  }

  // Formatar o timestamp em RFC3339 (ex: "2024-11-30T15:01:23Z")
  char timestamp[30];
  strftime(timestamp, sizeof(timestamp), "%Y-%m-%dT%H:%M:%SZ", &timeinfo);

  // Garantir que o timestamp termina com "Z" (se necessário)
  String timestampStr(timestamp);
  return timestampStr;  // A formatação já deve estar correta
}

void updatePessoaPresente() {
  // Obter o número atual de pessoas presentes
  int pessoasAtuais = getPessoas();

  if (pessoasAtuais > maxAlcancado) {
    maxAlcancado = pessoasAtuais;
  }

  if (pessoasAtuais < 0) {
    Serial.println("Erro ao obter número atual de pessoas.");
    return;
  }

  // Incrementa o valor (simula entrada de uma pessoa)
  pessoasAtuais += 1;

  // Caminho do documento a ser atualizado
  String academiaDocPath = "ACADEMIAS/2";

  // Registra a entrada na subcoleção "entradas"
  String entradasPath = academiaDocPath + "/entradas";  // Caminho da subcoleção entradas

  // Cria o conteúdo do novo documento na subcoleção "entradas"
  FirebaseJson entradaData;
  entradaData.set("fields/pessoaPresente/integerValue", pessoasAtuais);

  // Definir o timestamp usando o tempo atual em formato RFC3339
  String timestamp = getRFC3339Timestamp(); // Função que retorna o timestamp em RFC3339
  entradaData.set("fields/timestamp/timestampValue", timestamp);

  // Cria um novo documento na subcoleção "entradas"
  if (Firebase.Firestore.createDocument(&fbdo, FIREBASE_PROJECT_ID, "", entradasPath.c_str(), entradaData.raw())) {
    Serial.println("Entrada registrada com sucesso.");
  } else {
    Serial.printf("Falha ao registrar entrada: %s\n", fbdo.errorReason().c_str());
    return;  // Se falhar, não continua a atualização
  }

  // Cria um objeto FirebaseJson para o campo pessoaPresente
  FirebaseJson updateContent;
  updateContent.set("fields/pessoaPresente/integerValue", pessoasAtuais);

  // Atualiza o campo pessoaPresente no documento da academia
  if (Firebase.Firestore.patchDocument(&fbdo, FIREBASE_PROJECT_ID, "", academiaDocPath.c_str(), updateContent.raw(), "pessoaPresente")) {
    Serial.printf("Campo pessoaPresente atualizado para: %d\n", pessoasAtuais);
  } else {
    Serial.printf("Falha ao atualizar pessoaPresente: %s\n", fbdo.errorReason().c_str());
  }

  FirebaseJson updateMax;
  updateMax.set("fields/maxAlcancado/integerValue", maxAlcancado);

  if (Firebase.Firestore.patchDocument(&fbdo, FIREBASE_PROJECT_ID, "", academiaDocPath.c_str(), updateMax.raw(), "maxAlcancado")) {
    Serial.printf("Campo maxAlcancado atualizado para: %d\n", maxAlcancado);
  } else {
    Serial.printf("Falha ao atualizar maxAlcancado: %s\n", fbdo.errorReason().c_str());
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


