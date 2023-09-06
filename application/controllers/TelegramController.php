<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

class TelegramController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load library dan model yang akan digunakan di sini
    }

    public function index() {
        // Menerima data dari Telegram
        $telegramData = json_decode(file_get_contents('php://input'), true);

        // Lakukan pemrosesan sesuai dengan struktur data yang diterima dari Telegram
        // Contoh: mengambil ID chat dan pesan dari data yang diterima
        $chatId = $telegramData['message']['chat']['id'];
        $message = $telegramData['message']['text'];

        // Lakukan sesuatu berdasarkan pesan yang diterima
        $responseText = $this->processMessage($message);

        // Mengirimkan pesan balasan ke Telegram
        $this->sendMessageToTelegram($chatId, $responseText);
    }

    // Metode untuk mengirimkan pesan balasan ke Telegram
    private function sendMessageToTelegram($chatId, $message) {
        $botToken = '6260996234:AAGH33Ky9q9-a_5MIJdVDJaZwb7d3OjAsuo';
        $httpClient = new GuzzleHttp\Client();
        $response = $httpClient->post("https://api.telegram.org/bot$botToken/sendMessage", [
            'form_params' => [
                'chat_id' => $chatId,
                'text' => $message,
            ],
        ]);
    }

    // Metode untuk memproses pesan yang diterima dari pengguna
    private function processMessage($message) {
        // Lakukan pemrosesan pesan sesuai dengan logika aplikasi Anda
        // Contoh sederhana: jika pesan berisi "Halo", maka balas dengan pesan "Halo juga!"
        if (strtolower($message) === 'halo') {
            return "Halo juga!";
        } else {
            return "Saya tidak mengerti pesan Anda.";
        }
    }
}