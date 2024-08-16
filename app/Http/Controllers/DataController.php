<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DataController extends Controller
{
    public function show()
    {
        $data = [];
        return view('data', ['data' => $data]);
    }

    public function data(Request $request)
{
    $parameters = $request->all();

    $showData = [
        'datacore',
        'dataclass',
        'recordsperpage',
        'currentpageno',
        'condition',
        'order',
        'recordcount',
        'fields',
        'userid',
        'groupid',
        'businessid'
    ];

    $data = array_intersect_key($parameters, array_flip($showData));

    $password = $request->input('password');
    $uniqued = $request->input('uniqued');

    // Encrypt the data array
    $message = strtoupper($this->encrypt(json_encode($data), $password, $uniqued));

    // Prepare JSON Public Message
    $jsonPublicMessage = json_encode([
        'apikey' => $request->input('apikey'),
        'uniqueid' => $uniqued,
        'timestamp' => $request->input('timestamp'),
        'message' => $message
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    // Send the JSON Public Message to the URL
    $url = $request->input('url');
    $response = $this->sendRequest($url, $jsonPublicMessage);

    $encryptedResponseMessage = isset($response['message']) ? $response['message'] : null;

    // Mendekripsi pesan dari respons jika ada
    $responseMessage = isset($response['message']) ? $this->decrypt($response['message'], $password, $uniqued) : null;

    return view('data', [
        'data' => $data,
        'message' => $message,
        'apikey' => $request->input('apikey'),
        'uniqued' => $uniqued,
        'timestamp' => $request->input('timestamp'),
        'response' => $response,
        'jsonPublicMessage' => $jsonPublicMessage,
        'responseMessage' => $responseMessage,
        'encryptedResponseMessage' => $encryptedResponseMessage
    ]);
}


    private function encrypt($plaintext, $password, $iv)
    {
        $key = $password; // Directly using password as key
        $iv = $iv; // Directly using uniqued as IV

        $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        return strtoupper(bin2hex($ciphertext)); // Convert to uppercase hexadecimal
    }

    private function sendRequest($url, $jsonPublicMessage)
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($url, json_decode($jsonPublicMessage, true)); // Decode JSON string to array

            return $response->json(); // Decode JSON response to array
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
    private function decrypt($ciphertext, $password, $iv)
    {
        $key = $password; // Menggunakan password sebagai kunci
        $iv = $iv; // Menggunakan uniqued sebagai IV

        // Ubah hexadecimal kembali ke binary
        $ciphertext = hex2bin($ciphertext);

        $plaintext = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        return $plaintext;
    }


}
