<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LexFirmanteRedaccionDocumento extends Model
{
    use HasFactory;

    const ESTADO_FIRMA_PENDIENTE = 0; 
    const ESTADO_FIRMADO         = 1; 

    protected $table = 'lex_firmantes_redaccion_documento';

    protected $fillable = ['nombres', 'apellidos', 'correo', 'dni', 'estado', 'lex_redaccion_id', 'base64'];

    public function redaccion()
    {
        return $this->belongsTo(UserRedactaDocumento::class);
    }
}
