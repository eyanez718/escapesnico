<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo
     * 
     * @var string
     */
    protected $table = 'maquinas';

    /**
     * Atributos permitidos
     * 
     * @var array
     */
    protected $fillable = ['nombre', 'descripcion', 'usa_combustible'];
}
