<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LexCompra extends Model
{
    const ESTADO_COTIZANDO = 1;
    const ESTADO_PAGADO = 2;

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

    public static function saveCompras($userId, $guestId){

        $amount = 1111;
        
        $order = new LexCompra();
        $order->user_id =  $userId;
        $order->guest_id = $guestId;
        $order->institucion_id = 1;
        $order->forma_pago_id = 1; 
        $order->monto = $amount;
        $order->estado = LexCompra::ESTADO_COTIZANDO;
        if($order->save()){     
            
        }

        $order->monto = $amount;
        if($order->save()){
            return $order;
        }        

    }

}
