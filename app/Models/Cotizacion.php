<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'origen',
        'destino',
        'comentarios',
    ];

    // Relación con el modelo Contact
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
