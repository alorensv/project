<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LexFirmanteRedaccionDocumento extends Model
{
    use HasFactory;

    protected $table = 'lex_firmantes_redaccion_documento';

    protected $fillable = ['nombres', 'apellidos', 'correo', 'dni', 'estado', 'lex_redaccion_id'];

    public function redaccion()
    {
        return $this->belongsTo(UserRedactaDocumento::class);
    }
}
