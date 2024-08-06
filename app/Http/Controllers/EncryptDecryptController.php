<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EncryptDecryptController extends Controller
{
    public function show()
    {
        $keySecret = session('keySecret'); 
        return view('text.content', ['keySecret' => $keySecret]);
    }

    public function process(Request $request)
    {
        $action = $request->input('action');
        $keySecret = $request->session()->get('keySecret');

        if ($action == 'encrypt') {
            $plainText = $request->input('encrypt');
            if (empty($plainText)) {
                return view('text.content', ['isEmpty' => true]);
            }

            // Generate a new key for every encryption
            $keySecret = bin2hex(random_bytes(16)); 
            $request->session()->put('keySecret', $keySecret);
            
            // Encrypt with secret key
            $encryptedText = Crypt::encryptString($plainText . '::' . $keySecret);
            return view('text.content', ['encryptedText' => $encryptedText, 'keySecret' => $keySecret]);
        } elseif ($action == 'decrypt') {
            $encryptedText = $request->input('decrypt');
            $inputKeySecret = $request->input('keySecret');
            if (empty($encryptedText) || empty($inputKeySecret)) {
                return view('text.content', ['decryptIsEmpty' => true]);
            }

            try {
                $decryptedText = Crypt::decryptString($encryptedText);
                $keySecretFromText = substr($decryptedText, strpos($decryptedText, '::') + 2);

                if ($keySecretFromText === $inputKeySecret) {
                    $decryptedText = substr($decryptedText, 0, strpos($decryptedText, '::'));
                } else {
                    $decryptedText = "Secret key tidak valid!";
                }
            } catch (\Exception $e) {
                $decryptedText = "Teks yang dienkripsi tidak valid!";
            }
            return view('text.content', ['decryptedText' => $decryptedText]);
        }

        return view('text.content');
    }

}
