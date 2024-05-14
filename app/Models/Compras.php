<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Compras extends Model
{
   
    const ESTADO_COTIZANDO = 1; 

    use HasFactory;

    protected $table = 'compras';

    protected $fillable = ['user_id', 'forma_pago_id', 'monto', 'estado','user_direccion_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
