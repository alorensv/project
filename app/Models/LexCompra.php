<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LexCompra extends Model
{
    const ESTADO_COTIZANDO = 1;
    const ESTADO_PAGADO = 2;
    const ESTADO_RECHAZADO = 3;

    use HasFactory;

    protected $table = 'lex_compras';

    protected $fillable = [
        'user_id',
        'institucion_id',
        'forma_pago_id',
        'monto',
        'estado',
        'ultimos_num_tarjeta',
        'fecha_transaccion',
        'codigo_auth',
        'codigo_tipo_transaccion',
        'num_cuotas'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public static function saveCompras($userId, $guestId, $selectedItems){

        //$existeCompra = LexCompraServicio::getComprasPendientes($selectedItems);
        $amount = 0;
        
        $order = new LexCompra();
        $order->user_id =  $userId;
        $order->guest_id = $guestId;
        $order->institucion_id = 1;
        $order->forma_pago_id = 1; 
        $order->monto = $amount;
        $order->estado = LexCompra::ESTADO_COTIZANDO;
        if($order->save()){     


            foreach($selectedItems as $item){
                $servPagando = new LexCompraServicio();
                $servPagando->lex_compra_id= $order->id; 
                $servPagando->lex_user_redacta_documento_id= $item['id'];
                $servPagando->cantidad = 1; 
                $servPagando->monto = $item['precioDoc'];
                $servPagando->save();

                $amount = $amount + $servPagando->monto;
            }
            
        }

        $order->monto = $amount;
        if($order->save()){
            return $order;
        }        

    }

}
