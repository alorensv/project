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

    public function transportes_bulnes(){
        return view('tbl.transportes_bulnes');
    }

    public function presentacion(Request $request)
    {
        // Obtener el valor del parámetro 'name' desde la solicitud GET
        $nombre = $request->query('name');

        if($nombre == 'eduardo'){
            $response = [
                "foto" =>  '/img/tbl/perfil.png',
                "nombre" => 'Eduardo Pincheira Pinto',
                "cargo"  => 'Gerente de Operaciones',
                "empresa"=> 'Transportes Bulnes Limitada',
                "empresa2" => 'Comercial e Industrial Bulnes SPA',
                "funciones" => 'Traslados Maquinarias, equipos y carga general. Enfocados en sobredimensión.',
                "telefono" => '+56 9 78565544',
                "correo" => 'eduardo@empresasbulnes.com',
            ];
        }elseif($nombre == 'elias'){
            $response = [
                "foto" =>  '/img/tbl/perfil.png',
                "nombre" => 'Elías Sotomayor Henriquez',
                "cargo"  => 'Ingeniero en Prevención de Riesgos - N° Registro TH/P 718',
                "empresa"=> 'Transportes Bulnes Limitada',
                "empresa2" => 'Comercial e Industrial Bulnes SPA',
                "funciones" => 'Traslados Maquinarias, equipos y carga general. Enfocados en sobredimensión.',
                "telefono" => '+56 9 32699840',
                "correo" => 'elias@empresasbulnes.com',
            ];
        }elseif($nombre == 'friedel'){
            $response = [
                "foto" =>  '/img/tbl/perfil.png',
                "nombre" => 'Friedel Christ Constanzo',
                "cargo"  => 'Jefe de Proyectos Especiales',
                "empresa"=> 'Transportes Bulnes Limitada',
                "empresa2" => 'Comercial e Industrial Bulnes SPA',
                "funciones" => 'Traslados Maquinarias, equipos y carga general. Enfocados en sobredimensión.',
                "telefono" => '+56 9 62084589',
                "correo" => 'friedel@empresasbulnes.com',
            ];
        }
        
        return view('tbl.presentacion', $response);
    }

    public function getEquipos(){

        $response = [
            "message" => "equipos disponibles",
            "equipos" => [
                [
                    "id" => 1,
                    "nombre" => 'TRACTOS',
                    "marca" => 'VOLVO',
                    "modelo" => '2654 LS',
                    "descripcion" => 'descripcion',
                    "imagen" => '/img/tbl/equipos/tracto.png',
                ],
                [
                    "id" => 2,
                    "nombre" => 'TRACTOS',
                    "marca" => 'MERCEDES BENZ',
                    "modelo" => 'FH',
                    "descripcion" => 'descripcion',
                    "imagen" => '/img/tbl/equipos/tracto.png',
                ],
                [
                    "id" => 3,
                    "nombre" => 'TRACTOS',
                    "marca" => 'MERCEDES BENZ',
                    "modelo" => 'FH13',
                    "descripcion" => 'descripcion',
                    "imagen" => '/img/tbl/equipos/tracto.png',
                ],
                [
                    "id" => 4,
                    "nombre" => 'CAMAS BAJAS',
                    "marca" => 'TREMAC',
                    "modelo" => 'PT18 0007',
                    "descripcion" => 'descripcion',
                    "imagen" => '/img/tbl/equipos/cama_baja.png',
                ],
            ],
        ];
        

        return response()->json($response);
    }


    public function tiposEquipos(){

        $response = [
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
        ];
        

        return response()->json($response);        
    }
}
