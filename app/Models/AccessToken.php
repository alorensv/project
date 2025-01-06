<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    use HasFactory;

    protected $table = 'access_tokens';

    protected $fillable = ['token', 'user_id', 'email', 'module_id', 'expires_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'module_id');
    }

}
