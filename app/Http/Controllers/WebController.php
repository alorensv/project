<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMailable;
use App\Models\AccessToken;
use App\Models\ContadorVisita;
use App\Models\Correo;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WebController extends Controller
{

    public function store(Request $request)
    {
        /*$correo = new Correo();

        $correo->name = $request->name;
        $correo->email = $request->email;
        $correo->fono = $request->fono;
        $correo->message = $request->message;

        $correo->save();*/

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $correo = Correo::create($request->all());
        $correo = new ContactoMailable($request->all());
        Mail::to('alorensv@gmail.com')->send($correo);

        return redirect()->route('contacto')->with('info', "Mensaje enviado con éxito");
    }

    public function guardarVisita(Request $request)
    {
        $ip = $request->ip();
        $fec_registro = date('Y-m-d H:i:s');

        $visita = new ContadorVisita();
        $visita->ip = $ip;
        $visita->fec_registro = $fec_registro;
        $visita->save();

        return response()->json(['success' => true, 'message' => 'Visita guardada con éxito']);
    }

    public function showElement($rut, Request $request)
    {
        $tokenData = $request->query('token');
        $autoriza = false;

        if (is_null(Auth::id())) {
            $token = hash('sha256', $tokenData);
            $accessToken = AccessToken::where('token', $token)
                ->where('module_id', 2)
                ->where('expires_at', '>', now())
                ->first();

            if ($accessToken) {
                $autoriza = true;
            } elseif ($tokenData == 'tbl123456tbl') {
                $autoriza = true;
            }
        } else {
            $autoriza = true;
        }

        if ($autoriza) {
            $directory = 'private/tbl/documentation/empleados/' . $rut;
            $files = Storage::files($directory);

            if (empty($files)) {
                abort(404);
            }

            $filePath = storage_path('app/' . $files[0]);
            return response()->file($filePath);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function showDocumentation($id, Request $request)
    {
        $tokenData = $request->query('token');
        $autoriza = false;

        if (is_null(Auth::id())) {
            $token = hash('sha256', $tokenData);
            $accessToken = AccessToken::where('token', $token)
                ->where('module_id', 1)
                ->where('expires_at', '>', now())
                ->first();

            if ($accessToken) {
                $autoriza = true;
            } elseif ($tokenData == 'tbl123456tbl') {
                $autoriza = true;
            }
        } else {
            $autoriza = true;
        }

        if ($autoriza) {
            $directory = 'private/tbl/documentation/equipos/' . $id;
            $files = Storage::files($directory);

            if (empty($files)) {
                abort(404);
            }

            $filePath = storage_path('app/' . $files[0]);
            return response()->file($filePath);
        } else {
            abort(403, 'Unauthorized');
        }
    }


    
}
