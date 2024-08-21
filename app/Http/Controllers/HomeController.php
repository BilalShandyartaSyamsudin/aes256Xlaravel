<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function show()
    {
        // Retrieve message data from the database for the currently logged-in user
        $messageData = $this->getUserMessage();

        if (!$messageData) {
            return view('home', ['responseData' => []]);
        }

        // Prepare the JSON public message to send to the API
        $jsonPublicMessage = $this->preparePublicMessage($messageData->data);
        // Send request to the API
        $response = $this->sendRequest(env('API_URL'), $jsonPublicMessage);

        // Decrypt the response message
        $responseMessage = $this->decryptResponse($response);

        // Process and display the decrypted data in the view
        return view('home', [
            'responseData' => $this->mapResponseData($responseMessage),
        ]);
    }

    // Retrieve the user's message from the database
    private function getUserMessage()
    {
        return Message::where('user_id', Auth::id())->first();
    }

    // Prepare the public message in JSON format
    private function preparePublicMessage($data)
    {
        return json_encode([
            'apikey' => env('API_KEY'),
            'uniqueid' => env('UNIQUED'),
            'timestamp' => now()->format('Y/m/d H:i:s'),
            'message' => $data,
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    // Send a request to the specified API URL
    private function sendRequest($url, $jsonPublicMessage)
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($url, json_decode($jsonPublicMessage, true));

            return $response->json(); // Return the JSON-decoded response
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Decrypt the response message from the API
    private function decryptResponse($response)
    {
        if (!isset($response['message'])) {
            return null;
        }

        return $this->decrypt(
            $response['message'],
            env('PASSWORD'),
            env('UNIQUED')
        );
    }

    // Perform AES-256-CBC decryption
    private function decrypt($ciphertext, $password, $iv)
    {
        $ciphertext = hex2bin($ciphertext);
        return openssl_decrypt($ciphertext, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);
    }

    // Map the decrypted response data for display in the view
    private function mapResponseData($responseMessage)
    {
        if (!$responseMessage) {
            return [];
        }

        $responseData = json_decode($responseMessage, true);

        if (!is_array($responseData)) {
            return [];
        }

        return isset($responseData['data']) && is_array($responseData['data'])
            ? array_map(function ($item) {
                $item['image'] = trim($item['whcode']) . '.jpg';
                return $item;
            }, $responseData['data'])
            : [];
    }
}
