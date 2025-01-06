<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LexInstitucion extends Model
{
    use HasFactory;

    protected $table = 'lex_instituciones';

    protected $fillable = ['nombre', 'estado'];
    
}
