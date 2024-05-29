<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Compras extends Model
{
   
    const ESTADO_COTIZANDO = 1; 
    const ESTADO_PAGADO = 2; 

    use HasFactory;

    protected $table = 'compras';

    protected $fillable = ['user_id', 
                            'forma_pago_id', 
                            'monto', 
                            'estado',
                            'user_direccion_id',
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

    public function productos()
    {
        return $this->hasMany(CompraProductos::class, 'compra_id', 'id');
    }

    public static function getSessionCart(){
        $carts = session()->get('cart', []);

        $carrito = [];
        foreach ($carts as $key => $value) {
            $producto = Productos::find($key);
            $producto->cantidad = $value;
            $carrito[] = $producto;
        }
        return $carrito;
    }

    public static function getTotalamountCart(){
        $productos = self::getSessionCart();
        $amount = 0;
        foreach($productos as $producto){
            $amount = $amount + ($producto->costo * $producto->cantidad);
        } 

        return $amount;
    }

    public static function saveCompras($userId){

        $productos = self::getSessionCart();
        $amount = 0;

        $userDireccion = UserDirecciones::where('user_id', $userId)
                                ->where('is_default', 0)
                                ->first();
        
        $order = new Compras();
        $order->user_id =  $userId;
        $order->forma_pago_id = 1; 
        $order->monto = $amount;
        $order->estado = Compras::ESTADO_COTIZANDO;
        $order->user_direccion_id = $userDireccion->id; 
        if($order->save()){            

            foreach($productos as $producto){
                $detalleOrder = new CompraProductos();
                $detalleOrder->compra_id = $order->id; 
                $detalleOrder->producto_id = $producto->id; 
                $detalleOrder->cantidad = $producto->cantidad; 
                $detalleOrder->monto = ( $producto->cantidad * $producto->costo );
                if($detalleOrder->save()){
                    $productoOriginal = Productos::find($producto->id);
                    $productoOriginal->cantidad = $productoOriginal->cantidad - $detalleOrder->cantidad;
                    $productoOriginal->save();
                    $amount = $amount + ($producto->costo * $producto->cantidad);
                }
                //end foreach
            } 
        }

        $order->monto = $amount;
        if($order->save()){
            return $order;
        }        

    }

    public static function updateCompraTransbank($response){

        $formato_fecha = 'Y-m-d\TH:i:s.u\Z';
        $fecha = DateTime::createFromFormat($formato_fecha, $response->transaction_date);

        $id = $response->buy_order;
        $compra = Compras::find($id);
        $compra->ultimos_num_tarjeta = $response->card_detail->card_number;
        $compra->fecha_transaccion   = $fecha->format('Y-m-d H:i:s');
        $compra->codigo_auth         = $response->authorization_code;
        $compra->codigo_tipo_transaccion = $response->payment_type_code;
        $compra->num_cuotas              = $response->installments_number;
        if($compra->save()){
            return $compra; 
        }                                   

    }
    
}
