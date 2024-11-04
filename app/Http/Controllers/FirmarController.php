<?php

namespace App\Http\Controllers;

use App\Mail\NotificarFirma;
use App\Models\eCert;
use App\Models\LexCompraServicio;
use App\Models\LexFirmanteRedaccionDocumento;
use App\Models\User;
use App\Models\UserRedactaDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class FirmarController extends Controller
{
    //

    public function index(){
        return view('lex/firmas/home');
    }

    public function auth(Request $request)
    {
        // Recibir el idRedaccion desde la solicitud
        $idRedaccion = $request->input('idRedaccion');

        $user_id = auth()->check() ? auth()->id() : null;
        $token = null;

        if ($user_id) {
            $dniUsuario = User::where('id', $user_id)->value('dni');
            //$dniUsuario = '17.060.325-7';
            $firmante = LexFirmanteRedaccionDocumento::buscarPorDni($dniUsuario, $idRedaccion);
        }else{
            $token = $request->input('token');
        } 

        if(empty($firmante )) return response()->json(['error' => 'Firmante no encontrado'], 404); 

        // Buscar el documento en la tabla 'UserRedactaDocumento' por el idRedaccion
        $userRedactaDoc = UserRedactaDocumento::find($idRedaccion);

        if($userRedactaDoc) {
            $ruta = $userRedactaDoc->ruta;

            if ($ruta && Storage::exists($ruta)) {
                // Leer el contenido del archivo desde storage
                $pdf_content = Storage::get($ruta);

                // Convertir el contenido del archivo PDF a base64
                $pdf_base64 = base64_encode($pdf_content);
                // Crear la instancia de eCert y pasar el pdf_base64 si es necesario
                $authCert = new eCert($orden = 1, $tipo = 1);

                if (!is_null($authCert)) {
                    // Configurar la URL de retorno
                    $return_url = url('/home');
                    $authCert->setUrlCallback($return_url);

                    /* $UrlWebHook = url('/recibeDocumento');
                    $authCert->set_UrlWebHook($UrlWebHook); */
                    
                    //$authCert->setRutUsuario($dniUsuario);
                    $authCert->set_Email($firmante->correo); 
                    $authCert->set_Nombre(trim($firmante->nombres));
                    $authCert->set_ApellidoPaterno(trim($firmante->apellido_paterno));
                    $authCert->set_ApellidoMaterno(trim($firmante->apellido_materno));
                    $authCert->setPosicionFirmaY($firmante->posicion_firma_y);
                    $authCert->setPosicionFirmaX($firmante->posicion_firma_x);
                    $authCert->setPosicionFirmaPagina($firmante->posicion_firma_pagina);

                    $authCert->setNombreDocumento("documento_test2.pdf");
                    $authCert->setPDF($pdf_base64);
                    $authCert->Preinscripcion();
                    
                    $urlRedirect = $authCert->_UrlLoginECert;                    
	                $authCert->SubirDocumento();

                    // Obtener la ruta del archivo almacenado
                    $firmante = LexFirmanteRedaccionDocumento::iniciarProcesoFirma($dniUsuario, $userRedactaDoc->id, $authCert, $pdf_base64);
                    // Retornar el certificado junto con el PDF en base64
                    return response()->json([
                        'urlRedirect' => $urlRedirect,
                        'return_url' => $return_url
                    ]);
                }
            } else {
                return response()->json(['error' => 'Archivo no encontrado'], 404);
            }
        } else {
            return response()->json(['error' => 'Documento no encontrado'], 404);
        }
    }

    public function callback(){
        return view('lex/firmas/callback');
    }

    public function recibeDocumento()
    {
         // Obtener el JSON del body
        $json = file_get_contents('php://input');
        $objeto = json_decode($json);
        // Verificar si el JSON fue recibido
        if ($objeto) {
            $firmante = LexFirmanteRedaccionDocumento::finalizarProcesoFirma($objeto); 
        }
        
        return response()->json(['message' => 'firmantes actualizado', '$firmante' => $firmante]);
    }

    public function getDocumentosPendientesPagadoPerPage(Request $request)
    {
        $page   = $request->get('page', 1);
        $search = $request->get('search', '');
        $perPage = 10;
        

        $documentos = LexCompraServicio::docsPendientesPagadosPerPage($page, $perPage, $search);
        return response()->json(['message' => 'documentos disponibles', 'documentos' => $documentos]);
    }

    public function enviarCorreo(){
        echo "gola";

        $firmaDocumento = "hola";

        Mail::to(['alorensv@gmail.com'])->send(new NotificarFirma($firmaDocumento));
        return response()->json(['status' => 'ok'], 200);

    }
}
