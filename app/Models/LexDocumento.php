<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LexDocumento extends Model
{
    use HasFactory;

    protected $table = 'lex_documentos';

    protected $fillable = ['nombre', 'descripcion', 'default_text', 'imagen', 'estado','lex_categoria_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(LexCategoria::class, 'lex_categoria_id');
    }
    
}
