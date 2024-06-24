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

    public function servicio_sobredimensionado(){
        return view('tbl.servicio_sobredimensionado');
    }

    public function servicio_cargas_especiales(){
        return view('tbl.servicio_cargas_especiales');
    }

    public function equipos(){
        return view('tbl.equipos');
    }
}
