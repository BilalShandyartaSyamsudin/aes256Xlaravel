<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileEncryptController extends Controller
{
    public function show(){
        return view('file.file');
    }
}
