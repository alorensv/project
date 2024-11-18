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

    public function index()
    {
        return view('lex/firmas/home');
    }

    public function autorizaFirma(Request $request)
    {
        // Recibir el idRedaccion desde la solicitud
        $idRedaccion = $request->input('idRedaccion');

        $user_id = auth()->check() ? auth()->id() : null;
        $idFirmante = null;

        if ($user_id) {
            $dniUsuario = User::where('id', $user_id)->value('dni');
            $return_url = url('/home');
            //$dniUsuario = '17.060.325-7';
            $firmante = LexFirmanteRedaccionDocumento::buscarPorDni($dniUsuario, $idRedaccion);
        } else {
            $idFirmante = $request->input('idFirmante');
            $firmante = LexFirmanteRedaccionDocumento::find($idFirmante);
            $dniUsuario = $firmante->dni;
            $return_url = url('/callback/' . $firmante->token);
        }

        if (empty($firmante)) return response()->json(['error' => 'Firmante no encontrado'], 404);
        $userRedactaDoc = UserRedactaDocumento::find($idRedaccion);

        if ($userRedactaDoc) {
            $envioBase64 = $userRedactaDoc->base64;

            $authCert = new eCert($orden = 1, $tipo = 1);

            if (!is_null($authCert)) {
                $authCert->setUrlCallback($return_url);

                /* $UrlWebHook = url('/recibeDocumento');
                    $authCert->set_UrlWebHook($UrlWebHook); */

                $authCert->setRutUsuario($dniUsuario);
                $authCert->set_Email(trim($firmante->correo));
                $authCert->set_Nombre(trim($firmante->nombres));
                $authCert->set_ApellidoPaterno(trim($firmante->apellido_paterno));
                $authCert->set_ApellidoMaterno(trim($firmante->apellido_materno));
                $authCert->setPosicionFirmaY($firmante->posicion_firma_y);
                $authCert->setPosicionFirmaX($firmante->posicion_firma_x);
                $authCert->setPosicionFirmaPagina($firmante->posicion_firma_pagina);

                $authCert->setNombreDocumento("documento_test3.pdf");
                $authCert->setPDF($envioBase64);
                $authCert->Preinscripcion();

                $urlRedirect = $authCert->_UrlLoginECert;
                $authCert->SubirDocumento();

                // Obtener la ruta del archivo almacenado
                $firmante = LexFirmanteRedaccionDocumento::iniciarProcesoFirma($dniUsuario, $userRedactaDoc->id, $authCert, $envioBase64);
                // Retornar el certificado junto con el PDF en base64
                return response()->json([
                    'urlRedirect' => $urlRedirect,
                    'return_url' => $return_url
                ]);
            }
        } else {
            return response()->json(['error' => 'Documento no encontrado'], 404);
        }
    }

    public function callback($token)
    {

        $firmaDocumento = LexFirmanteRedaccionDocumento::where('token', $token)->first();
        $redaccion = UserRedactaDocumento::where('id', $firmaDocumento->lex_redaccion_id)->first();

        if (is_null($firmaDocumento)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se pudo encontrar firmante con token asociado',
                'error' => 404
            ], 404);
        }

        $base64PDF = $redaccion->base64; // Esta función obtiene el PDF en Base64

        return view('lex/firmas/callback', compact('base64PDF', 'firmaDocumento', 'redaccion'));
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

    public function firmantesPendientes($idRedaccion)
    {
        $firmantes = LexFirmanteRedaccionDocumento::getFirmantesPendientes($idRedaccion);
        return response()->json(['message' => 'firmantes pendientes', 'firmantes' => $firmantes]);
    }

    public function firmantes($idRedaccion)
    {
        $firmantes = LexFirmanteRedaccionDocumento::getFirmantes($idRedaccion);
        return response()->json(['message' => 'firmantes', 'firmantes' => $firmantes]);
    }

    public function enviarCorreo($idFirmante)
    {
        $firmaDocumento = LexFirmanteRedaccionDocumento::find($idFirmante);
        if (!$firmaDocumento) {
            return response()->json(['status' => 'error', 'message' => 'Firmante no encontrado'], 404);
        }

        $token = bin2hex(random_bytes(30)); // Genera un token de 60 caracteres

        $expiration = now()->addDays(5); // Establece la expiración en 5 días a partir de ahora
        $duration = $expiration->diffInMinutes(now()); // Calcula la duración en minutos


        $firmaDocumento->token = hash('sha256', $token);
        $firmaDocumento->expires_at = $expiration;
        if ($firmaDocumento->save()) {
            Mail::to([$firmaDocumento->correo, 'alorensv@gmail.com'])->send(new NotificarFirma($firmaDocumento));
            return response()->json(['status' => 'ok', 'datos' => $firmaDocumento], 200);
        }
    }

    public function firmarDocumento($token)
    {
        $firmaDocumento = LexFirmanteRedaccionDocumento::where('token', $token)->first();
        $redaccion = UserRedactaDocumento::where('id', $firmaDocumento->lex_redaccion_id)->first();

        if (is_null($firmaDocumento)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se pudo encontrar firmante con token asociado',
                'error' => 404
            ], 404);
        }

        $base64PDF = $redaccion->base64; // Esta función obtiene el PDF en Base64

        return view('lex.firmas.firmarDocumento', compact('base64PDF', 'firmaDocumento', 'redaccion'));
    }
}
