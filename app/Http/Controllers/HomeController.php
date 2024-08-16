<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function show()
    {
        $url = env('API_URL');
        $apikey = env('API_KEY');
        $uniqued = env('UNIQUED');
        $password = env('PASSWORD');
        $timestamp = now()->format('Y/m/d H:i:s');
        $data = [
            'datacore' => env('DATACORE'),
            'dataclass' => env('DATA_CLASS'),
            'recordsperpage' => env('RECORDSPERPAGE'),
            'currentpageno' => env('CURRENTPAGENO'),
            'condition' => env('CONDITION'),
            'order' => env('ORDER'),
            'recordcount' => env('RECORDCOUNT'),
            'fields' => env('FIELDS'),
            'userid' => env('USER_ID'),
            'groupid' => env('GROUP_ID'),
            'businessid' => env('BUSINESS_ID')
        ];

        $message = strtoupper($this->encrypt(json_encode($data), $password, $uniqued));

        $jsonPublicMessage = json_encode([
            'apikey' => $apikey,
            'uniqueid' => $uniqued,
            'timestamp' => $timestamp,
            'message' => $message
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        $response = $this->sendRequest($url, $jsonPublicMessage);

        $responseMessage = isset($response['message']) ? $this->decrypt($response['message'], $password, $uniqued) : null;

        $responseData = json_decode($responseMessage, true);

        $mappedData = array_map(function($item) {
            $whcodeTrimmed = trim($item['whcode']);
            $item['image'] = $whcodeTrimmed . '.jpg'; 
            return $item;
        }, $responseData['data'] ?? []);

        return view('home', [
            'responseData' => $mappedData,
        ]);
    }

    private function encrypt($plaintext, $password, $iv)
    {
        $key = $password;
        $iv = $iv;

        $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        return strtoupper(bin2hex($ciphertext));
    }

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

    private function decrypt($ciphertext, $password, $iv)
    {
        $key = $password;
        $iv = $iv;

        $ciphertext = hex2bin($ciphertext);

        $plaintext = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        return $plaintext;
    }
}
