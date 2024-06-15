<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebtblController extends Controller
{
    //
    public function index()
    {
        return view('tbl.inicio');
    }
}
