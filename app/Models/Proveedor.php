<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo
     * 
     * @var string
     */
    protected $table = 'proveedores';

    /**
     * Atributos permitidos
     * 
     * @var array
     */
    protected $fillable = ['nombre', 'descripcion', 'email'];
}
