<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraProductos extends Model
{
    use HasFactory;

    protected $table = 'compra_productos';

    protected $fillable = ['compra_id', 'producto_id', 'cantidad', 'monto'];

    public function compra()
    {
        return $this->belongsTo(Compras::class);
    }

    public function producto()
    {
        return $this->belongsTo(Productos::class);
    }
}
