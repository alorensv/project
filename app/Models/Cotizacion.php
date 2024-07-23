<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = "cotizaciones";

    protected $fillable = [
        'contact_id',
        'nombre',
        'email',
        'telefono',
        'fecha_servicio',
        'fecha_termino',
        'origen',
        'destino',
        'largo',
        'alto',
        'ancho',
        'peso',
        'equipo_id',
        'servicio_id',
        'comentarios',
    ];

    // Relación con el modelo Contact
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }

    public static function fullCotizaciones($page, $perPage)
    {
        $query = "SELECT c.id, c.nombre, c.email, c.telefono, c.fecha_servicio, c.fecha_termino, c.origen, c.destino, c.comentarios,
                c.largo, c.alto, c.ancho, c.peso,
                c.equipo_id, e.nombre as nombreEquipo, e.patente as patente, e.marca as marcaEquipo, e.modelo as modeloEquipo, s.nombre as nombreServicio, c.created_at
                FROM cotizaciones c
                LEFT JOIN equipos e ON c.equipo_id = e.id
                LEFT JOIN servicios s ON c.servicio_id = s.id
                ORDER BY c.created_at desc";

        $selectData = collect(DB::select($query));

        // Paginación manual
        $offset = ($page * $perPage) - $perPage;
        $itemsForCurrentPage = $selectData->slice($offset, $perPage)->values();

        return new LengthAwarePaginator($itemsForCurrentPage, $selectData->count(), $perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
    }

}
