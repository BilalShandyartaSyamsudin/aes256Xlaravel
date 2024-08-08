<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function show(){
        $data = [];
        return view('data.data', ['data' => $data]);
    }

    public function data(Request $request){
        $parameters  = $request->all();

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
        $encryptedData = strtoupper($this->encrypt(json_encode($data), $password, $uniqued));

        return view('data.data', [
            'data' => $data,
            'encryptedData' => $encryptedData,
            'apikey' => $request->input('apikey'),
            'uniqued' => $uniqued,
            'timestamp' => $request->input('timestamp')
        ]);
    }

    private function encrypt($plaintext, $password, $iv){
        $key = $password; // Directly using password as key
        $iv = $iv; // Directly using uniqued as IV

        $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        return strtoupper(bin2hex($ciphertext)); // Convert to uppercase hexadecimal
    }
}
