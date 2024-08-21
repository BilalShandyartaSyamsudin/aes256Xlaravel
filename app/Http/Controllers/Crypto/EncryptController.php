<?php

namespace App\Http\Controllers\Crypto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EncryptController extends Controller
{
    public function show(){
        return view('crypto.encrypt');
    }
}
