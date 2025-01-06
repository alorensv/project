<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LexInputsDocumento extends Model
{
    use HasFactory;

    protected $table = 'lex_inputs_documentos';

    protected $fillable = ['name', 'label', 'placeholder', 'field_type', 'help_text',  'orden', 'required', 'documento_id'];

    public function redaccionDocumento()
    {
        return $this->belongsTo(UserRedactaDocumento::class, 'lex_redaccion_id');
    }
}
