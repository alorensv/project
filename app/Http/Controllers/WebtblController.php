<?php

namespace App\Http\Controllers;

use App\Mail\ContactReceived;
use App\Mail\NuevaCotizacion;
use App\Models\Contact;
use App\Models\ContactMessage;
use App\Models\ContadorVisita;
use App\Models\Cotizacion;
use App\Models\Equipo;
use App\Models\TiposEquipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function transporte_equipos_forestales(){
        return view('tbl.transporte_equipos_forestales');
    }

    public function rescate_equipos_siniestrados(){
        return view('tbl.rescate_equipos_siniestrados');
    }

    public function transporte_maquinaria(){
        return view('tbl.transporte_maquinaria');
    }

    public function servicios_izajes(){
        return view('tbl.servicios_izajes');
    }

    public function venta_combustible(){
        return view('tbl.venta_combustible');
    }

    public function equipos(){
        return view('tbl.equipos');
    }

    public function transportes_bulnes(){
        return view('tbl.transportes_bulnes');
    }

    public function presentacion(Request $request)
    {
        // Obtener el valor del parámetro 'name' desde la solicitud GET
        $nombre = $request->query('name');

        if($nombre == 'eduardo'){
            $response = [
                "foto" =>  '/img/tbl/perfil_eduardo.png',
                "nombre" => 'Eduardo Pincheira Pinto',
                "cargo"  => 'Gerente de Operaciones',
                "empresa"=> 'Transportes Bulnes Limitada',
                "empresa2" => 'Comercial e Industrial Bulnes SPA',
                "funciones" => 'Transporte de maquinaria, equipo y carga general.',
                "telefono" => '+56 9 78565544',
                "correo" => 'eduardo@empresasbulnes.com',
            ];
        }elseif($nombre == 'elias'){
            $response = [
                "foto" =>  '/img/tbl/perfil_elias.png',
                "nombre" => 'Elías Sotomayor Henriquez',
                "cargo"  => 'Ingeniero en Prevención de Riesgos',
                "empresa"=> 'Transportes Bulnes Limitada',
                "empresa2" => 'Comercial e Industrial Bulnes SPA',
                "funciones" => 'Transporte de maquinaria, equipo y carga general.',
                "telefono" => '+56 9 32699840',
                "correo" => 'elias@empresasbulnes.com',
            ];
        }elseif($nombre == 'friedel'){
            $response = [
                "foto" =>  '/img/tbl/perfil_friedel.png',
                "nombre" => 'Friedel Christ Constanzo',
                "cargo"  => 'Jefe de Proyectos Especiales',
                "empresa"=> 'Transportes Bulnes Limitada',
                "empresa2" => 'Comercial e Industrial Bulnes SPA',
                "funciones" => 'Transporte de maquinaria, equipo y carga general.',
                "telefono" => '+56 9 62084589',
                "correo" => 'friedel@empresasbulnes.com',
            ];
        }
        
        return view('tbl.presentacion', $response);
    }

    public function presentacionEquipo(Request $request)
    {
        // Obtener el valor del parámetro 'name' desde la solicitud GET
        $id = $request->query('id');
        $response = Equipo::find($id);        
        
        return view('tbl.presentacionEquipo', $response);
    }

    public function getEquipos(Request $request){

        // Obtener subcategorias del request
        $subcategorias = $request->input('subcategorias');

        if (empty($subcategorias)) {
            //$equipos = Equipo::all();

           $equipos = Equipo::fullEquipos();

            //$productos = Productos::where('cantidad', '>', 0)->get();
        } else {
            $equipos = Equipo::whereIn('subtipo_id', $subcategorias)
            ->where('active', 1)
            ->get();

        }

        return response()->json(['message' => 'equipos disponibles', 'equipos' => $equipos]);
 
    }


    public function tiposEquipos(){

        /* $response = [
            "datos" => [
                [
                    "id" => 1,
                    "nombre" => 'TRACTOS',
                    "caracteristicas" => [
                        [
                            "id" => '1',
                            "nombre" => 'Tracción 6x4 hp desde 440 a 540',
                        ],
                        [
                            "id" => '2',
                            "nombre" => 'Tracción 6x4 hp desde 500 a 540',
                        ],
                    ]
                ],
                [
                    "id" => 2,
                    "nombre" => 'RAMPLAS',
                    "caracteristicas" => [
                        [
                            "id" => '3',
                            "nombre" => 'Normal',
                        ],
                        [
                           "id" => '4',
                            "nombre" => 'Extensible',
                        ],
                    ]
                ],
            ],
        ]; */

        $datos = TiposEquipo::obtenerTiposConSubtipos();
        //dd($datos);
        return response()->json(['datos' => $datos]);
              
    }

    public function guardarContacto(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'correo' => 'required|string|email|max:255',
            'comentarios' => 'required|string',
        ]);

        // Limpiar el correo electrónico (aplicar trim)
        $email = trim($validatedData['correo']);

        // Buscar el contacto por correo electrónico
        $contact = Contact::where('email', $email)->first();

        if ($contact) {
            // Si el contacto existe, crear un nuevo mensaje
            $message = new ContactMessage([
                'contact_id' => $contact->id,
                'message' => $validatedData['comentarios'],
            ]);
        } else {
            // Si el contacto no existe, crear el contacto y registrar su comentario
            $contact = Contact::create([
                'name' => $validatedData['nombre'],
                'email' => $email,
                'phone' => $validatedData['telefono'],
            ]);

            $message = new ContactMessage([
                'contact_id' => $contact->id,
                'message' => $validatedData['comentarios'],
            ]);
        }

        // Guardar el mensaje y enviar el correo si se guarda correctamente
        if ($message->save()) {
            Mail::to(['alorensv@gmail.com', 'eduardo@empresasbulnes.com', 'elias@empresasbulnes.com', 'friedel@empresasbulnes.com'])->send(new ContactReceived($contact, $message->message));
            return response()->json(['status' => 'ok'], 200);
        }else{
            return response()->json(['status' => 'error'], 500);
        }

        // Retornar respuesta en formato JSON
       
    }

    public function guardarCotizacion(Request $request)
    {

        
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'telefono' => 'nullable|string|max:255',
            'fecha_servicio' => 'nullable|date|max:255',
            'fecha_termino' => 'nullable|date|max:255',
            'origen' => 'nullable|string|max:255',
            'destino' => 'nullable|string|max:255',
            'largo' => 'nullable|string|max:255',
            'ancho' => 'nullable|string|max:255',
            'alto' => 'nullable|string|max:255',
            'peso' => 'nullable|string|max:255',
            'equipo.id' => 'nullable|integer|exists:equipos,id',
            'servicioId' => 'nullable|integer|exists:cotizaciones,id',
            'comentarios' => 'required|string',
        ]);

        //dd($validatedData);

        $email = trim($validatedData['email']);
        $contact = Contact::where('email', $email)->first();
        if (!$contact) {
            // Si el contacto no existe, crearlo
            $contact = Contact::create([
                'name' => $validatedData['nombre'],
                'email' => $email,
                'phone' => $validatedData['telefono'],
            ]);
        }

        $cotizacion = Cotizacion::create([
            'contact_id' => $contact->id,
            'nombre'    => $validatedData['nombre'],
            'email'     => $email,
            'telefono'  => $validatedData['telefono'],
            'fecha_servicio' => $validatedData['fecha_servicio'],
            'fecha_termino' => $validatedData['fecha_termino'] ?? null,
            'origen'    => $validatedData['origen'],
            'destino'   => $validatedData['destino'] ?? null,
            'largo'     => $validatedData['largo'] ?? null,
            'ancho'     => $validatedData['ancho'] ?? null,
            'alto'      => $validatedData['alto'] ?? null,
            'peso'      => $validatedData['peso'] ?? null,
            'equipo_id' => $validatedData['equipo']['id'] ?? null,
            'servicio_id' => $validatedData['servicioId'] ?? null,
            'comentarios' => $validatedData['comentarios'],
        ]);

        if ($cotizacion) {
            // Enviar el correo
            try {
                // Enviar el correo
                Mail::to(['alorensv@gmail.com', 'eduardo@empresasbulnes.com', 'elias@empresasbulnes.com', 'friedel@empresasbulnes.com'])->send(new NuevaCotizacion($cotizacion));
                return response()->json(['status' => 'ok', 'message' => 'Correo enviado correctamente', 'cotizacion' => $cotizacion], 200);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => 'Error al enviar el correo: ' . $e->getMessage(), 'cotizacion' => $cotizacion], 500);
            }
        }else{
            return response()->json(['status' => 'error', 'cotizacion' => $cotizacion], 200);
        }

        // Retornar respuesta en formato JSON
        
    }

    public function cantidadVisitas(){

        $cantidad = ContadorVisita::count();

        return response()->json([ 'cantidad' => $cantidad]);
    }
}
