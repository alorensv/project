<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LexWebController extends Controller
{
    
    public function index()
    {
        return view('lex.inicio');
    }

    public function redactar(){
        return view('lex.redactar');
    }

}
