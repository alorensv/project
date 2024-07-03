<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContadorVisita extends Model
{
    use HasFactory;

    protected $table = 'contador_visita';

    protected $fillable = ['ip', 'fec_registro'];


    public $timestamps = false; // Deshabilitar timestamps automáticos

}
