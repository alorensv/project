<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
            SELECT doc.nombre AS nombreDoc, cs.cantidad, cs.monto FROM lex_compra_servicios cs
				INNER JOIN lex_user_redacta_documento urd ON urd.id = cs.lex_user_redacta_documento_id
				INNER JOIN lex_documentos doc ON doc.id = urd.documento_id
				WHERE cs.lex_compra_id = $compraId ";

        $params = [];

        $serviciosPagados = collect(DB::select($query, $params));
        return $serviciosPagados;
    }

}
