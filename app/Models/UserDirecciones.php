<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDirecciones extends Model
{
    use HasFactory;
    
    protected $table = 'user_direcciones';

    protected $fillable = ['region', 'comuna', 'codigo_postal', 'direccion','nombre_contacto', 'fono_contacto','is_default'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
