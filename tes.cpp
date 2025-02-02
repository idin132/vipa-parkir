#include <SPI.h>
#include <MFRC522.h>
#include <ESP32Servo.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <SoftwareSerial.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include "DFRobotDFPlayerMini.h"

#define SS_PIN  5  // Pin untuk RFID
#define RST_PIN 4 // Pin reset RFID
#define SERVO_PIN 13  // Pin servo
#define IR_SENSOR_PIN 32 // Pin sensor IR

static const uint8_t PIN_MP3_TX = 25; // Connects to module's RX 
static const uint8_t PIN_MP3_RX = 26; // Connects to module's TX 
SoftwareSerial softwareSerial(PIN_MP3_RX, PIN_MP3_TX);
DFRobotDFPlayerMini player;

MFRC522 rfid(SS_PIN, RST_PIN); // Membuat instance MFRC522
Servo myServo; // Membuat instance servo
LiquidCrystal_I2C lcd(0x27, 16, 2); // Inisialisasi LCD dengan alamat I2C 0x27

// Konfigurasi WiFi
const char* ssid = "Naufal";  // Ganti dengan SSID WiFi Anda
const char* password = "13122004";  // Ganti dengan password WiFi Anda

// URL Server API (Ganti dengan URL server Anda)
const char* allowedUIDsURL = "http://192.168.1.36:8000/api/allowed-uids";
const char* handleTapURL = "http://192.168.1.36:8000/api/handle-tap";
const char* storeIDURL = "http://192.168.1.36:8000/api/store-id_card";

bool accessGranted;

void setup() {
    Serial.begin(115200);
    softwareSerial.begin(9600);
    if (!player.begin(softwareSerial)) {
        Serial.println("DFPlayer gagal memulai.");
    } else {
        Serial.println("DFPlayer siap.");
        player.volume(50);  // Setel volume
    }
    SPI.begin(); // Inisialisasi SPI bus
    rfid.PCD_Init(); // Inisialisasi RFID reader
    myServo.attach(SERVO_PIN); // Hubungkan servo ke pin yang sesuai
    myServo.write(0); // Tutup pintu pada awal
    pinMode(IR_SENSOR_PIN, INPUT); // Mengatur pin sensor IR sebagai input
    // LCD
    lcd.begin();    // Inisialisasi LCD dengan ukuran 16x2
    lcd.backlight();       // Mengaktifkan lampu latar LCD
    lcd.clear();
    lcd.print("Scan RFID...");
    lcd.setCursor(0, 1);
    lcd.print("Gate Control Ready");
    delay(2000);
    lcd.clear();
    Serial.println("Siapkan sensor IR dan scan kartu RFID untuk membuka pintu...");

    // Sambungkan ke WiFi
    Serial.print("Menghubungkan ke WiFi");
    WiFi.begin(ssid, password);
    while (WiFi.status() != WL_CONNECTED) {
        delay(1000);
        Serial.print(".");
    }
    Serial.println("\nWiFi Terhubung!");
    Serial.print("ESP32 IP Address: ");
    Serial.println(WiFi.localIP());
}

void loop() {
    if (rfid.PICC_IsNewCardPresent() && rfid.PICC_ReadCardSerial()) {
        String uid = "";
        for (byte i = 0; i < rfid.uid.size; i++) {
            uid += String(rfid.uid.uidByte[i], HEX); // Mendapatkan UID dalam format hex
        }
        uid.toUpperCase();
        lcd.clear();
        lcd.setCursor(0, 0);
        lcd.print("UID: ");
        lcd.setCursor(0, 1);
        lcd.print(uid);
        Serial.print("UID kartu: ");
        Serial.println(uid);
        
        if (digitalRead(IR_SENSOR_PIN) == LOW) { // Memeriksa apakah objek terdeteksi oleh sensor IR
            lcd.clear();
            lcd.setCursor(0, 0);
            lcd.print("Objek terdeteksi!");
            Serial.println("Objek terdeteksi. RFID aktif.");
            accessGranted = handleTap(uid);
            
            if (accessGranted) {
                delay(1000);
                lcd.clear();
                lcd.setCursor(0, 0);
                lcd.print("Akses diterima!");
                Serial.println("Akses diterima! Membuka pintu...");
                myServo.write(90); // Membuka pintu dengan memutar servo
                MP();
                delay(5000); // Tunggu 5 detik sebelum menutup kembali
                myServo.write(0); // Menutup pintu
            } else {
                lcd.clear();
                lcd.setCursor(0, 0);
                lcd.print("Akses ditolak!");
                Serial.println("Akses ditolak!");
                MP();
                sendToServer(uid); // Kirim UID ke server jika akses ditolak
            }

            rfid.PICC_HaltA(); // Hentikan komunikasi dengan kartu
        }
    } else {
        lcd.clear();
        lcd.setCursor(0, 0);
        lcd.print("Hallo");
                lcd.setCursor(0, 1);
        lcd.print("Scan RFID...");
        Serial.println("Menunggu deteksi objek...");
    }
  
    delay(500); // Jeda untuk mencegah pembacaan terus-menerus
}

void MP(){
    if (accessGranted) {
        player.play(1);  // Mainkan track 1 jika akses diterima
    } else {
        player.play(2);  // Mainkan track 2 jika akses ditolak
    }
}

bool handleTap(String uid) {
    bool granted = false;
    if (WiFi.status() == WL_CONNECTED) {
        HTTPClient http;
        http.begin(handleTapURL);
        http.addHeader("Content-Type", "application/x-www-form-urlencoded");

        String postData = "id_card=" + uid;
        int httpResponseCode = http.POST(postData);

        if (httpResponseCode > 0) {
            String response = http.getString();
            Serial.println("Response dari Server: " + response);
            granted = response.indexOf("Proses berhasil.") >= 0;
        } else {
            Serial.print("Gagal mengirim data! HTTP Response Code: ");
            Serial.println(httpResponseCode);
        }
        http.end();
    } else {
        Serial.println("WiFi tidak terhubung!");
    }
    return granted;
}

void sendToServer(String id_card) {
    if (WiFi.status() == WL_CONNECTED) {
        HTTPClient http;
        http.begin(storeIDURL);
        http.addHeader("Content-Type", "application/x-www-form-urlencoded");

        String postData = "id_card=" + id_card;
        int httpResponseCode = http.POST(postData);

        if (httpResponseCode > 0) {
            String response = http.getString();
            Serial.println("Response dari Server: " + response);
        } else {
            Serial.print("Gagal mengirim data! HTTP Response Code: ");
            Serial.println(httpResponseCode);
        }
        http.end();
    } else {
        Serial.println("WiFi tidak terhubung!");
    }
}