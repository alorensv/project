<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class UserRedactaDocumento extends Model
{
    use HasFactory;

    const ESTADO_PROCESO_BORRADOR = 0; 
    const ESTADO_PROCESO_PENDIENTE_FIRMA   = 0; 
    const ESTADO_PROCESO_FIRMADO = 0; 

    protected $table = 'lex_user_redacta_documento';

    protected $fillable = ['user_id', 'documento_id', 'institucion_id', 'redaccion','estado', 'ruta', 'guest_id','base64', 'final_base64'  ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documento()
    {
        return $this->belongsTo(LexDocumento::class);
    }

    public function institucion()
    {
        return $this->belongsTo(LexInstitucion::class);
    }

    public static function redaccionesPorPagarPerPage($page, $perPage, $search = null)
    {
        $page = (int) $page;
        $perPage = (int) $perPage;

        $query = "SELECT r.*, doc.nombre as nombreDoc, doc.precio as precioDoc
            FROM lex_user_redacta_documento r
            INNER JOIN lex_documentos doc on doc.id = r.documento_id
            WHERE 1=1 ";

        $params = [];

        if(auth()->check()){
            $user_id = auth()->id(); 
            $query .= " AND user_id = $user_id";
        }else{

            if (!session()->has('guest_id')) {
                $guest_id = uniqid('guest_', true); // O cualquier identificador único que quieras usar
                session(['guest_id' => $guest_id]);
            }

            $guest_id = session('guest_id');

            $query .= " AND guest_id = '$guest_id'";
        }

        $query .= " ORDER BY r.id DESC";

        $selectData = collect(DB::select($query, $params));

        $offset = ($page - 1) * $perPage;
        $itemsForCurrentPage = $selectData->slice($offset, $perPage)->values();

   
        return new LengthAwarePaginator($itemsForCurrentPage, $selectData->count(), $perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
    }

}
