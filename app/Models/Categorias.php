<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 


class Categorias extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    public function subcategorias()
    {
        // Especifica explícitamente el nombre de la columna de la clave externa
        return $this->hasMany(Subcategorias::class, 'categoria_id');
    }

    public static function categoriasHasSubcategorias()
    {
        $query = "SELECT c.id AS id_categoria, c.nombre AS nombre_categoria,
                         s.id AS id_subcategoria, s.nombre AS nombre_subcategoria
                  FROM categorias c
                  JOIN subcategorias s ON c.id = s.categoria_id";

        $selectData = DB::select($query);

        return $selectData;
    }

    public static function obtenerCategoriasConSubcategorias()
    {
        $categorias = self::with('subcategorias')->get();
        
        $categoriasConSubcategorias = [];
        
        foreach ($categorias as $categoria) {
            // Verificar si la categoría tiene subcategorías asociadas y no es nula
            if ($categoria->subcategorias && is_iterable($categoria->subcategorias)) {
                $subcategorias = [];
                
                foreach ($categoria->subcategorias as $subcategoria) {
    
                    $subcategorias[] = [
                        'id' => $subcategoria->id,
                        'nombre' => $subcategoria->nombre,
                    ];
                }
    
                $categoriasConSubcategorias[] = [
                    'id' => $categoria->id,
                    'nombre' => $categoria->nombre,
                    'subcategorias' => $subcategorias
                ];
            }
        }
        
        return $categoriasConSubcategorias;
    }


  

}
