<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $fillable = [
        'rut',
        'nombres',
    ];

    public static function fullEmpleadosPerPage($page, $perPage, $search = null)
    {
        // Asegúrate de que $page y $perPage sean enteros
        $page = (int) $page;
        $perPage = (int) $perPage;
        
        // Consulta base
        $query = "SELECT c.id, c.rut, c.nombres
                FROM empleados c WHERE 1=1 ";
        
        // Parámetros de la consulta
        $params = [];
        
        if (!empty($search)) {
            $query .= "AND (c.nombres LIKE ? OR c.rut LIKE ? ) ";
            $searchTerm = "%{$search}%";
            $params = array_merge($params, [$searchTerm, $searchTerm]);
        }
        
        // Ordenar los resultados
        $query .= " ORDER BY c.nombres ASC";
        
        // Ejecutar la consulta con parámetros opcionales
        $selectData = collect(DB::select($query, $params));
        
        // Paginación manual
        $offset = ($page - 1) * $perPage; // Corregido para ser calculado correctamente
        $itemsForCurrentPage = $selectData->slice($offset, $perPage)->values();
        
        return new LengthAwarePaginator($itemsForCurrentPage, $selectData->count(), $perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
    }

}
