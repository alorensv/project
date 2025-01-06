<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class LexCompraServicio extends Model
{
    use HasFactory;

    protected $table = 'lex_compra_servicios';

    protected $fillable = ['lex_compra_id', 'lex_user_redacta_documento_id', 'cantidad', 'monto'];

    public function compra()
    {
        return $this->belongsTo(LexCompra::class);
    }

    public function userRedactaDocumento()
    {
        return $this->belongsTo(UserRedactaDocumento::class);
    }

    public static function getComprasPendientes($selectItems){
        $query = "SELECT *
            FROM lex_user_redacta_documento
            WHERE id in ()";

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

        $carrito = collect(DB::select($query, $params));
        return $carrito;
    }

    public static function getServiciosPendientesPorPagar(){

        $query = "SELECT *
            FROM lex_user_redacta_documento
            WHERE estado = 1 ";

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

        $carrito = collect(DB::select($query, $params));
        return $carrito;
    }

    public static function getServiciosPagadosById($compraId){
        $query = "
            SELECT urd.id as idRedaccion, doc.nombre AS nombreDoc, cs.cantidad, cs.monto FROM lex_compra_servicios cs
				INNER JOIN lex_user_redacta_documento urd ON urd.id = cs.lex_user_redacta_documento_id
				INNER JOIN lex_documentos doc ON doc.id = urd.documento_id
				WHERE cs.lex_compra_id = $compraId ";

        $params = [];

        $serviciosPagados = collect(DB::select($query, $params));
        return $serviciosPagados;
    }

    public static function docsPendientesPagadosPerPage($page, $perPage, $search = null)
    {
        $page = (int) $page;
        $perPage = (int) $perPage;
        $dni = auth()->user()->dni;
        $query = "SELECT compra.id as idCompra, 
        compra.monto AS monto,
        compra.fecha_transaccion AS fechaCompra,
        urd.id as idRedaccion, 
        doc.nombre AS nombreDoc, 
        (SELECT COUNT(*) 
            FROM lex_firmantes_redaccion_documento firm_p 
        WHERE firm_p.lex_redaccion_id = urd.id 
        AND firm_p.estado = 0) AS firmasPendientes,
        (SELECT COUNT(*) 
        FROM lex_firmantes_redaccion_documento firm_o 
        WHERE firm_o.lex_redaccion_id = urd.id 
        AND firm_o.estado = 2) AS firmasOk,
        (SELECT COUNT(*) 
        FROM lex_firmantes_redaccion_documento firm_o 
        WHERE firm_o.lex_redaccion_id = urd.id 
        AND firm_o.estado = 3) AS firmasRechazadas,
        (SELECT COUNT(*) 
        FROM lex_firmantes_redaccion_documento firm_o 
        WHERE firm_o.lex_redaccion_id = urd.id 
        AND firm_o.estado = 0 AND firm_o.dni = '$dni' ) AS pormi,
        urd.base64, 
        urd.final_base64,
        DATE_FORMAT(urd.created_at, '%d-%m-%Y') AS fecha_creacion,
        DATE_FORMAT(urd.updated_at, '%d-%m-%Y') AS fecha_actualizacion
        FROM lex_compras compra
        INNER JOIN lex_compra_servicios cs ON compra.id = cs.lex_compra_id
        INNER JOIN lex_user_redacta_documento urd ON urd.id = cs.lex_user_redacta_documento_id
        INNER JOIN lex_documentos doc ON doc.id = urd.documento_id
        WHERE compra.estado = 2 AND (
        urd.user_id = " . auth()->user()->id . " 
        OR EXISTS (
            SELECT 1 
            FROM lex_firmantes_redaccion_documento b 
            WHERE urd.id = b.lex_redaccion_id 
            AND b.dni = '" . $dni . "'
            )
        )";

        $params = [];

        if (!empty($search)) {
            $query .= "AND (doc.nombre LIKE ? OR c.rut LIKE ? ) ";
            $searchTerm = "%{$search}%";
            $params = array_merge($params, [$searchTerm, $searchTerm]);
        }

        $query .= " ORDER BY compra.id ASC";


        $selectData = collect(DB::select($query, $params));

        $offset = ($page - 1) * $perPage;
        $itemsForCurrentPage = $selectData->slice($offset, $perPage)->values();

        /* $itemsForCurrentPage->transform(function ($empleado) {
            $empleado->img_url = url('empleados/photo/' . $empleado->rut);
            return $empleado;
        }); */

        return new LengthAwarePaginator($itemsForCurrentPage, $selectData->count(), $perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
    }


}
