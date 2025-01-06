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
        'apellidos',
        'telefono',
        'email',
        'status',
        'cargo_id',
        'img',
        'direccion',
    ];

    public static function fullEmpleadosPerPage($page, $perPage, $search = null)
    {
        $page = (int) $page;
        $perPage = (int) $perPage;

        $query = "SELECT c.*
            FROM empleados c WHERE 1=1 ";

        $params = [];

        if (!empty($search)) {
            $query .= "AND (c.nombres LIKE ? OR c.rut LIKE ? ) ";
            $searchTerm = "%{$search}%";
            $params = array_merge($params, [$searchTerm, $searchTerm]);
        }

        $query .= " ORDER BY c.nombres ASC";

        $selectData = collect(DB::select($query, $params));

        $offset = ($page - 1) * $perPage;
        $itemsForCurrentPage = $selectData->slice($offset, $perPage)->values();

        $itemsForCurrentPage->transform(function ($empleado) {
            $empleado->img_url = url('empleados/photo/' . $empleado->rut);
            return $empleado;
        });

        return new LengthAwarePaginator($itemsForCurrentPage, $selectData->count(), $perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
    }
}
