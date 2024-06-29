<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubtiposEquipo extends Model
{
    use HasFactory;

    protected $table = 'subtipos_equipo';

    protected $fillable = ['nombre', 'tipo_id'];

    public function tipo()
    {
        return $this->belongsTo(TiposEquipo::class, 'tipo_id');
    }

    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'subtipo_id');
    }
    
}
