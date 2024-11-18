<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LexFirmanteRedaccionDocumento extends Model
{
    use HasFactory;

    const ESTADO_FIRMA_PENDIENTE    = 0; 
    const ESTADO_FIRMA_EN_PROCESO   = 1; 
    const ESTADO_FIRMADO            = 2; 
    const ESTADO_FIRMA_CANCELADA    = 3; 
    const ARRAY_POSICIONES_FIRMAS = [
        0 => [
            'posicion_firma_y' => 0,
            'posicion_firma_x' => 0,
            'posicion_firma_pagina' => 0,
        ],
        1 => [
            'posicion_firma_y' => 0,
            'posicion_firma_x' => 200,
            'posicion_firma_pagina' => 0,
        ],
        2 => [
            'posicion_firma_y' => 0,
            'posicion_firma_x' => 400,
            'posicion_firma_pagina' => 0,
        ]
    ];

    protected $table = 'lex_firmantes_redaccion_documento';

    protected $fillable = [
        'nombres', 
        'apellido_paterno', 
        'apellido_materno', 
        'correo', 
        'dni', 
        'domicilio',
        'comuna',
        'region',
        'estado', 
        'lex_redaccion_id', 
        'base64', 
        'posicion_firma_y',
        'posicion_firma_x',
        'posicion_firma_pagina',
        'IdUsuarioECert', 
        'DoctoId', 
        'base64_enviado', 
        'firmado', 
        'razon_rechazo',
        'token',
        'expires_at'
    ];
    

    public function redaccion()
    {
        return $this->belongsTo(UserRedactaDocumento::class, 'lex_redaccion_id');
    }


    public static function buscarPorDni($rut, $lex_redaccion_id)
    {
        // Aplicar trim al rut
        $rut = trim($rut);
        
        // Buscar por dni y lex_redaccion_id y devolver el primer resultado
        return self::where('dni', $rut)
                    ->where('lex_redaccion_id', $lex_redaccion_id)
                    ->first();
    }

    public static function buscarPorToken($token, $lex_redaccion_id)
    {        
        // Buscar por dni y lex_redaccion_id y devolver el primer resultado
        return self::where('token', $token)
                    ->where('lex_redaccion_id', $lex_redaccion_id)
                    ->first();
    }

    public static function buscarPorDocId($docId)
    {
        return self::where('DoctoId', $docId)->first();
    }

    public static function countFirmantesPendientes($lex_redaccion_id)
    {
        return self::where('lex_redaccion_id', $lex_redaccion_id)
                   ->where('estado','<>', 2)
                   ->count();
    }

    public static function getFirmantesPendientes($idRedaccion) {
        return self::whereIn('estado', [0, 1])
                    ->where('lex_redaccion_id', $idRedaccion)
                    ->get();
    }

    public static function getFirmantes($idRedaccion) {
        return self::where('lex_redaccion_id', $idRedaccion)
                    ->get();
    }

    public static function getDatosParaNofiticar($idFirmante){
        $query = "SELECT frd.nombres, frd.apellido_paterno, frd.correo, 
            doc.nombre AS documento, u.`name` AS owner, urd.id AS codigo
            FROM lex_firmantes_redaccion_documento frd
            INNER JOIN lex_user_redacta_documento urd ON urd.id = frd.lex_redaccion_id
            INNER JOIN lex_documentos doc ON doc.id = urd.documento_id
            LEFT JOIN users u ON u.id = urd.user_id
            WHERE frd.estado IN (0,1) and frd.id = $idFirmante";

        $data = collect(DB::select($query));
        return $data;
    }
    
    public static function guardarFirmantesDoc($firmantes, $documento){
        // Guardar los firmantes
        foreach ($firmantes as $index => $firmante) {

            $posiciones = LexFirmanteRedaccionDocumento::ARRAY_POSICIONES_FIRMAS[$index] ?? null;
            $rutLimpio = preg_replace('/\./', '', $firmante['rut']);

            LexFirmanteRedaccionDocumento::create([
                'lex_redaccion_id' => $documento->id,
                'nombres' => $firmante['nombre'],
                'apellido_paterno' => $firmante['apellido_paterno'] ?? '',
                'apellido_materno' => $firmante['apellido_materno'] ?? '',
                'correo' => $firmante['correo'],
                'dni' => $rutLimpio,
                'domicilio' => $firmante['domicilio'] ?? '',
                'comuna' => $firmante['comuna'] ?? '',
                'region' => $firmante['region'] ?? '',
                'estado' => 0,
                'posicion_firma_y' => $posiciones['posicion_firma_y'] ?? null,
                'posicion_firma_x' => $posiciones['posicion_firma_x'] ?? null,
                'posicion_firma_pagina' => $posiciones['posicion_firma_pagina'] ?? null,
            ]);
        }
    }

    public static function iniciarProcesoFirma($rut, $lex_redaccion_id, $authCert, $envioBase64)
    {
        $firmante = self::buscarPorDni($rut, $lex_redaccion_id);
        
        if ($firmante) {
            $firmante->base64_enviado = $envioBase64; 
            $firmante->IdUsuarioECert = $authCert->_IdUsuarioECert; 
            $firmante->DoctoId = $authCert->_DocumentoId; 
            $firmante->estado = LexFirmanteRedaccionDocumento::ESTADO_FIRMA_EN_PROCESO;
            return $firmante->save();
        }

        return false; // Retornar false si no se encuentra el firmante
    }

    public static function finalizarProcesoFirma($objeto)
    {
        $firmante = self::buscarPorDocId($objeto->DoctoId);
        
        if ($firmante) {
            $firmante->DoctoId = $objeto->DoctoId; 
            $firmante->firmado = $objeto->Firmado; 
            $firmante->razon_rechazo = $objeto->RazonRechazo; 
            $firmante->base64 =  $objeto->DoctoBase64;
            $firmante->estado = LexFirmanteRedaccionDocumento::ESTADO_FIRMADO;
            if($firmante->save()){
                $redaccion = UserRedactaDocumento::find($firmante->lex_redaccion_id);
                $redaccion->base64 = $firmante->base64;

                $firmantesPendientes = self::countFirmantesPendientes($firmante->lex_redaccion_id);
                if($firmantesPendientes == 0){
                    $redaccion->final_base64 = $firmante->base64;
                }

                $redaccion->save();
            }         
            
            

            return $firmante;
        }

        return null; // Retornar false si no se encuentra el firmante
    }



}
