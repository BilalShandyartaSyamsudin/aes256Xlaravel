<?php

namespace App\Http\Controllers\Crypto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DecryptController extends Controller
{
    public function show(){
        return view('crypto.decrypt');
    }
}
