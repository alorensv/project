<?php

namespace App\Http\Controllers;
use App\Mail\ContactoMailable;
use App\Models\Correo;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class WebController extends Controller
{

    public function store(Request $request){
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


}
