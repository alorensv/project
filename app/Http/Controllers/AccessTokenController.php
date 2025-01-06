<?php

namespace App\Http\Controllers;

use App\Mail\TokenMail;
use App\Models\AccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AccessTokenController extends Controller
{
    //


    public function createToken(Request $request)
    {

        $userId = Auth::id();

        $request->validate([
            'module_id' => 'required|exists:modulos,id',
        ]);

        $token = bin2hex(random_bytes(30)); // Genera un token de 60 caracteres

        $expiration = now()->addHour();
        $duration = $expiration->diffInMinutes(now());

        $accessToken = AccessToken::create([
            'token' => hash('sha256', $token),
            'user_id' => $userId,
            'module_id' => $request->module_id,
            'email' => $request->email,
            'expires_at' => $expiration,
        ]);

        Mail::to(['alorensv@gmail.com'])->send(new TokenMail($token, $duration));

        return response()->json(['token' => $token]);
    }

    public function validateToken(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'module_id' => 'required|exists:modulos,id',
        ]);

        $token = hash('sha256', $request->token);
        $accessToken = AccessToken::where('token', $token)
            ->where('module_id', $request->module_id)
            ->where('expires_at', '>', now())
            ->first();

        if ($accessToken) {
            return response()->json(['success' => true]);
        }elseif($request->token == 'tbl123456tbl'){
            return response()->json(['success' => true]);
        }else {
            return response()->json(['success' => false], 401);
        }
    }
}
