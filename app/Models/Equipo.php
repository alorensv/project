<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
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
        'num_verificador',
        'color',
        'subtipo_id',
        'link_ficha_tecnica',
        'full_documentation',
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
        $query = "SELECT c.id, c.tipo_id, c.nombre, c.anio, c.marca, c.modelo, c.patente, c.color, c.subtipo_id, 
                    c.link_ficha_tecnica, c.img, c.active, c.full_documentation, c.num_verificador,
                  t.nombre as nombreTipo, st.nombre as nombreSubtipo
                  FROM equipos c
                  JOIN tipos_equipo t ON c.tipo_id = t.id
                  JOIN subtipos_equipo st ON c.subtipo_id = st.id
                  WHERE c.active = 1
                  ORDER BY c.tipo_id asc, c.anio desc";

        $selectData = DB::select($query);

        return $selectData;
    }

    public static function fullEquiposPerPage($page, $perPage, $subtipo = null, $search = null)
    {
        // Asegúrate de que $page y $perPage sean enteros
        $page = (int) $page;
        $perPage = (int) $perPage;
        
        // Consulta base
        $query = "SELECT c.id, c.tipo_id, c.nombre, c.anio, c.marca, c.modelo, c.patente, c.color, c.subtipo_id, c.link_ficha_tecnica, c.img, c.active, c.num_verificador, c.full_documentation,
                t.nombre as nombreTipo, st.nombre as nombreSubtipo
                FROM equipos c
                JOIN tipos_equipo t ON c.tipo_id = t.id
                JOIN subtipos_equipo st ON c.subtipo_id = st.id WHERE 1=1 ";
        
        // Parámetros de la consulta
        $params = [];
        
        // Condición para el filtro opcional
        if (is_array($subtipo) && !empty($subtipo)) {
            $placeholders = implode(',', array_fill(0, count($subtipo), '?'));
            $query .= "AND  c.subtipo_id IN ($placeholders)";
            $params = $subtipo;
        } elseif (!empty($subtipo)) {
            $query .= "AND  c.subtipo_id = ?";
            $params[] = $subtipo;
        }

        if (!empty($search)) {
            $query .= "AND (c.nombre LIKE ? OR c.marca LIKE ? OR c.modelo LIKE ? OR c.patente LIKE ? OR c.anio LIKE ?) ";
            $searchTerm = "%{$search}%";
            $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
        }
        
        // Ordenar los resultados
        $query .= " ORDER BY c.tipo_id ASC, id asc";
        
        // Ejecutar la consulta con parámetros opcionales
        $selectData = collect(DB::select($query, $params));
        
        // Paginación manual
        $offset = ($page - 1) * $perPage; // Corregido para ser calculado correctamente
        $itemsForCurrentPage = $selectData->slice($offset, $perPage)->values();

        $itemsForCurrentPage->transform(function ($equipo) {
            $equipo->doc_url = url('equipos/documentation/' . $equipo->id);
            return $equipo;
        });
        
        return new LengthAwarePaginator($itemsForCurrentPage, $selectData->count(), $perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
    }
}
