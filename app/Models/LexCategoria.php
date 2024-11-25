<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LexCategoria extends Model
{
    use HasFactory;

    protected $table = 'lex_categorias';

    protected $fillable = ['nombre'];

    public function documentos()
    {
        return $this->hasMany(LexDocumento::class);
    }

    public static function categoriasDocumentos()
    {
        $query = "SELECT c.id AS id_categoria, c.nombre AS nombre_categoria, d.id as id_documento, 
                         d.nombre AS documento, d.precio
                  FROM lex_categorias c
                  JOIN lex_documentos d ON c.id = d.lex_categoria_id";

        $selectData = DB::select($query);

        return $selectData;
    }

}
