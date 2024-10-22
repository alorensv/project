<?php

namespace App\Http\Controllers;

use App\Models\eCert;
use App\Models\LexCompraServicio;
use App\Models\LexFirmanteRedaccionDocumento;
use App\Models\UserRedactaDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

        // Buscar el documento en la tabla 'UserRedactaDocumento' por el idRedaccion
        $userRedactaDoc = UserRedactaDocumento::find($idRedaccion);

        if($userRedactaDoc) {
            // Obtener la ruta del archivo almacenado
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

                    $UrlWebHook = url('/recibeDocumento');
                    $authCert->set_UrlWebHook($UrlWebHook);

                    $authCert->setNombreDocumento("documento_test.pdf");
                    $authCert->setPDF($pdf_base64);
                    $authCert->Preinscripcion();
                    
                    $urlRedirect = $authCert->_UrlLoginECert;                    
	                $authCert->SubirDocumento();

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
        Log::info('recibeDocumento invocado.');
    
        // Obtener el JSON del body
        $json = file_get_contents('php://input');
        $objeto = json_decode($json);
    
        // Verificar si el JSON fue recibido
        if ($objeto) {
            Log::info('JSON recibido:', ['json' => $objeto]);
        } else {
            Log::error('Error: No se recibió JSON válido.');
        }
    
        // Buscar el firmante
        $id = 1; // Ajusta esto dinámicamente si es necesario
        $firmante = LexFirmanteRedaccionDocumento::find($id);
        
        if ($firmante) {
            Log::info('Firmante encontrado:', ['id' => $firmante->id]);
    
            // Guardar el Base64
            $firmante->base64 = $objeto->DoctoBase64;
            $firmante->save();
    
            Log::info('Documento base64 guardado correctamente.');
        } else {
            Log::error('Error: Firmante no encontrado con ID: ' . $id);
        }
    
        // Mostrar el contenido del objeto
        dd($objeto);
    }

    public function getDocumentosPendientesPagadoPerPage(Request $request)
    {
        $page   = $request->get('page', 1);
        $search = $request->get('search', '');
        $perPage = 10;
        

        $documentos = LexCompraServicio::docsPendientesPagadosPerPage($page, $perPage, $search);
        return response()->json(['message' => 'documentos disponibles', 'documentos' => $documentos]);
    }
}
