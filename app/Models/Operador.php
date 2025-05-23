<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Operador extends Authenticatable
{
    use HasFactory;
    protected $table = 'operadores';

    protected $fillable = ['nombre', 'contrasenia'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',  'contrasenia', 
    ];

    // 👇 Laravel espera un campo 'password', así que lo redefinimos
    public function getAuthPassword()
    {
        return $this->contrasenia;
    }
}
