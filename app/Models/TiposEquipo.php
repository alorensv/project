<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposEquipo extends Model
{
    use HasFactory;

    protected $table = 'tipos_equipo';

    protected $fillable = ['nombre'];

    public function subtipos()
    {
        return $this->hasMany(SubtiposEquipo::class, 'tipo_id');
    }

    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'tipo_id');
    }

    public static function obtenerTiposConSubtipos()
    {
        $tipos = self::with('subtipos')->get();
        
        $TiposConSubtipos = [];
        
        foreach ($tipos as $tipo) {
            // Verificar si el equipo tiene subtipo asociadas y no es nula
            if ($tipo->subtipos && is_iterable($tipo->subtipos)) {
                $subtipos = [];
                
                foreach ($tipo->subtipos as $subcategoria) {
    
                    $subtipos[] = [
                        'id' => $subcategoria->id,
                        'nombre' => $subcategoria->nombre,
                    ];
                }
    
                $TiposConSubtipos[] = [
                    'id' => $tipo->id,
                    'nombre' => $tipo->nombre,
                    'caracteristicas' => $subtipos
                ];
            }
        }
        
        return $TiposConSubtipos;
    }

}
