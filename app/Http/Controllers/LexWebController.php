<?php

namespace App\Http\Controllers;

use App\Models\UserRedactaDocumento;
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

    public function carroCompras(){
        return view('lex/market/carro');
    }

    public function guardarRedaccion(Request $request)
    {
        $instId = 1; 
        $userId = 1; 
        // Validar los datos de entrada
        $request->validate([
            'ruta' => 'nullable|string|max:255',
        ]);

        $user_id = auth()->check() ? auth()->id() : null;
        if (!$user_id) {

            if (!session()->has('guest_id')) {
                $guest_id = uniqid('guest_', true); // O cualquier identificador único que quieras usar
                session(['guest_id' => $guest_id]);
            }
            
            $guest_id = session('guest_id');
        }

        // Preparar la redacción como JSON con los inputs
        $redaccion = [
            'comuna' => $request->input('comuna'),
            // Puedes agregar otros campos aquí como lo necesites
            // 'nombre' => $request->input('nombre'), 
            // 'rut' => $request->input('rut'),
        ];

        $documento = UserRedactaDocumento::updateOrCreate(
            [
                'user_id' => $user_id,
                'guest_id' => $guest_id ?? null,
                'documento_id' => $request->input('documento_id'),
            ],
            [
                'institucion_id' => $instId,
                'redaccion' => json_encode($redaccion),
                'estado' => 1,
                'ruta' => $request->input('ruta', null),
            ]
        );

        // Responder con el documento creado o actualizado
        return response()->json(['documento' => $documento], 201);
    } 

    public function getRedaccionesPorPagar(Request $request)
    {  
        $page   = $request->get('page', 1);
        $search = $request->get('search', '');
        $perPage = 10;
        

        $redacciones = UserRedactaDocumento::redaccionesPorPagarPerPage($page, $perPage, $search);
        return response()->json(['message' => 'redacciones disponibles', 'redacciones' => $redacciones]);
    }


}
