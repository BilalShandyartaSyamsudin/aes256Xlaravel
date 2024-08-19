<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function show()
    {
        // Ambil data message dari database berdasarkan user yang sedang login
        $messageData = Message::where('user_id', Auth::id())->first();

        if (!$messageData) {
            return view('home', ['responseData' => []]);
        }

        // Gunakan data dari database
        $url = $messageData->url;
        $apikey = $messageData->apikey;
        $uniqued = $messageData->uniqued;
        $password = $messageData->password;
        $timestamp = now()->format('Y/m/d H:i:s');
        $data = $messageData->data;

        // Enkripsi data
        $message = strtoupper($this->encrypt(json_encode($data), $password, $uniqued));

        $jsonPublicMessage = json_encode([
            'apikey' => $apikey,
            'uniqueid' => $uniqued,
            'timestamp' => $timestamp,
            'message' => $message
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        // Kirim request ke API
        $response = $this->sendRequest($url, $jsonPublicMessage);

        // Dekripsi response
        $responseMessage = isset($response['message']) ? $this->decrypt($response['message'], $password, $uniqued) : null;

        $responseData = json_decode($responseMessage, true);

        // Proses response data untuk ditampilkan di view
        $mappedData = array_map(function($item) {
            $whcodeTrimmed = trim($item['whcode']);
            $item['image'] = $whcodeTrimmed . '.jpg'; 
            return $item;
        }, $responseData['data'] ?? []);

        return view('home', [
            'responseData' => $mappedData,
        ]);
    }

    // Fungsi untuk enkripsi
    private function encrypt($plaintext, $password, $iv)
    {
        $key = $password;
        $iv = $iv;

        $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        return strtoupper(bin2hex($ciphertext));
    }

    // Fungsi untuk mengirim request ke API
    private function sendRequest($url, $jsonPublicMessage)
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($url, json_decode($jsonPublicMessage, true));

            return $response->json();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Fungsi untuk dekripsi
    private function decrypt($ciphertext, $password, $iv)
    {
        $key = $password;
        $iv = $iv;

        $ciphertext = hex2bin($ciphertext);

        $plaintext = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        return $plaintext;
    }
}