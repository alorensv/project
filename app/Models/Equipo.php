<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';

    protected $fillable = [
        'tipo_id',
        'nombre',
        'anio',
        'marca',
        'modelo',
        'patente',
        'color',
        'subtipo_id',
        'link_ficha_tecnica',
        'img'
    ];

    public function tipo()
    {
        return $this->belongsTo(TiposEquipo::class, 'tipo_id');
    }

    public function subtipo()
    {
        return $this->belongsTo(SubtiposEquipo::class, 'subtipo_id');
    }

    public static function fullEquipos()
    {
        $query = "SELECT c.id, c.tipo_id, c.nombre, c.anio, c.marca, c.modelo, c.patente, c.color, c.subtipo_id, c.link_ficha_tecnica, c.img,
                  t.nombre as nombreTipo, st.nombre as nombreSubtipo
                  FROM equipos c
                  JOIN tipos_equipo t ON c.tipo_id = t.id
                  JOIN subtipos_equipo st ON c.subtipo_id = st.id
                  ORDER BY c.tipo_id asc";

        $selectData = DB::select($query);

        return $selectData;
    }
}
