<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\Equipo;
use App\Models\TiposEquipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



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

    public function adminCotizaciones(){
        return view('tbl.intranet.adminCotizaciones');
    }

    public function getCotizaciones(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = 10;

        $cotizaciones = Cotizacion::fullCotizaciones($page, $perPage);
        return response()->json(['message' => 'cotizaciones disponibles', 'cotizaciones' => $cotizaciones]);
    }

    public function getEquiposPerPage(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = 10;

        $equipos = Equipo::fullEquiposPerPage($page, $perPage);
        return response()->json(['message' => 'equipos disponibles', 'equipos' => $equipos]);
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

    public function agregarEquipo(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'tipo_id' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'patente' => 'required|string|max:255',
            'num_verificador' => 'nullable|string|max:2',
            'color' => 'required|string|max:255', // Asegúrate de que el formato sea correcto
            'img' => 'nullable|file',
            'link_ficha_tecnica' => 'nullable|file' ,
            'full_documentation' => 'nullable|file' ,
        ]);

        //dd($request->input('num_verificador'));
    
        if ($request->has('id')) {
            // Actualizar el equipo existente
            $equipo = Equipo::find($request->input('id'));
            if ($equipo) {
                $equipo->update([
                    'tipo_id' => $request->input('tipo_id'),
                    'nombre' => $request->input('nombre'),
                    'anio' => $request->input('anio'),
                    'marca' => $request->input('marca'),
                    'modelo' => $request->input('modelo'),
                    'patente' => $request->input('patente'),
                    'num_verificador' => $request->input('num_verificador'),
                    'color' => $request->input('color'),
                    'subtipo_id' => $request->input('subtipo_id'),
                ]);
            } else {
                // Manejar el caso cuando el equipo no es encontrado
                return response()->json(['error' => 'Equipo no encontrado'], 404);
            }
        } else {
            // Crear el nuevo equipo
            $equipo = Equipo::create([
                'tipo_id' => $request->input('tipo_id'),
                'nombre' => $request->input('nombre'),
                'anio' => $request->input('anio'),
                'marca' => $request->input('marca'),
                'modelo' => $request->input('modelo'),
                'patente' => $request->input('patente'),
                'num_verificador' => $request->input('num_verificador'),
                'color' => $request->input('color'),
                'subtipo_id' => $request->input('subtipo_id'),
            ]);
        }
    
        // Manejar la subida del archivo
        if ($request->hasFile('link_ficha_tecnica')) {
            $file = $request->file('link_ficha_tecnica');
            $directory = public_path('/img/tbl/' . $equipo->id); 
    
            // Crear la carpeta si no existe
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
    
            // Almacenar el archivo en la carpeta
            $filePath = $directory . '/' . $file->getClientOriginalName();
            $file->move($directory, $file->getClientOriginalName());
            $equipo->link_ficha_tecnica = '/img/tbl/' . $equipo->id . '/' . $file->getClientOriginalName();
            $equipo->save();
        }
        
        // Manejar la subida del archivo
        if ($request->hasFile('full_documentation')) {
            $file = $request->file('full_documentation');
            $directory = public_path('/private/tbl/documentation/' . $equipo->id); 
    
            // Crear la carpeta si no existe
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
    
            // Almacenar el archivo en la carpeta
            $filePath = $directory . '/' . $file->getClientOriginalName();
            $file->move($directory, $file->getClientOriginalName());
            $equipo->full_documentation = '/private/tbl/documentation/' . $equipo->id . '/' . $file->getClientOriginalName();
            $equipo->save();
        }

        // Manejar la subida del archivo
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $directory = public_path('/img/tbl/' . $equipo->id); 
    
            // Crear la carpeta si no existe
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
    
            // Almacenar el archivo en la carpeta
            $filePath = $directory . '/' . $file->getClientOriginalName();
            $file->move($directory, $file->getClientOriginalName());
            $equipo->img = '/img/tbl/' . $equipo->id . '/' . $file->getClientOriginalName();
            $equipo->save();
        }
        
    
        // Responder con el equipo creado o actualizado
        return response()->json(['equipo' => $equipo], 201);
    }
    
    
    
    

    
    
    public function activarEquipo(Request $request){
        $equipo = Equipo::find($request->id);
        if ($equipo) {
            $equipo->active = !$equipo->active;
            $equipo->save();
            return response()->json(['success' => true, 'message' => 'Estado del equipo actualizado correctamente.']);
        }
        return response()->json(['success' => false, 'message' => 'Equipo no encontrado.']);
    
    }

  
}
