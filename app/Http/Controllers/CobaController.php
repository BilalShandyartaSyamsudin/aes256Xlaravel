<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CobaController extends Controller
{
    public function show(){
        $coba = [];

        return view('coba', ['coba' => $coba]);
    }
    public function cobaPost(Request $request){
        $coba = $request->all();

        return view('coba', ['coba' => $coba]);
    }
}
