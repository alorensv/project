<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\TiposEquipo;
use Illuminate\Http\Request;

class IntranetTblController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('intranet.index');
    }

    public function adminEquipos()
    {
        return view('tbl.intranet.adminEquipos');
    }

    // IntranetTblController.php
    public function agregarTipoEquipo(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $tipo = TiposEquipo::create([
            'nombre' => $request->input('nombre'),
        ]);

        return response()->json(['tipo' => $tipo], 201);
    }

    // IntranetTblController.php
    public function agregarEquipo(Request $request)
    {


        // Validación de los datos de entrada
        $request->validate([
            'tipo_id' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'anio' => 'required|integer|min:1900|max:'.date('Y'),
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'patente' => 'required|string|max:255',
            'color' => 'required|string|max:7', // Color en formato hexadecimal (#rrggbb)
            'subtipo_id' => 'nullable|integer',
            'link_ficha_tecnica' => 'nullable|url',
            'img' => 'nullable|url' // Cambia a 'image' si esperas una imagen cargada en lugar de una URL
        ]);
    
        // Crear el nuevo equipo
        $equipo = Equipo::create([
            'tipo_id' => $request->input('tipo_id'),
            'nombre' => $request->input('nombre'),
            'anio' => $request->input('anio'),
            'marca' => $request->input('marca'),
            'modelo' => $request->input('modelo'),
            'patente' => $request->input('patente'),
            'color' => $request->input('color'),
            'subtipo_id' => $request->input('subtipo_id'),
            'link_ficha_tecnica' => $request->input('link_ficha_tecnica'),
            'img' => $request->input('img'),
        ]);
    
        // Responder con el equipo creado
        return response()->json(['equipo' => $request->all()], 201);
    }
    
    


  
}
