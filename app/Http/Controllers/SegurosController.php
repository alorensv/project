<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SegurosController extends Controller
{
    
    public function index()
    {
        return view('seguros.web.inicio');
    }

}
