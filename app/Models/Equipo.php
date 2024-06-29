<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';

    protected $fillable = [
        'tipo_id', 'nombre', 'anio', 'marca', 'modelo', 'patente', 
        'color', 'subtipo_id', 'link_ficha_tecnica', 'img'
    ];

    public function tipo()
    {
        return $this->belongsTo(TiposEquipo::class, 'tipo_id');
    }

    public function subtipo()
    {
        return $this->belongsTo(SubtiposEquipo::class, 'subtipo_id');
    }
}
