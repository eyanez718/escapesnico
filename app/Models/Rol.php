<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Atributos permitidos
     *
     * @var array
     */
    protected $fillable = ['nombre', 'descripcion'];

    /**
     * Relación con el modelo Usuario
     * 
     * @return array(Usuario)
     */
    public function usuarios() {
        return $this->hasMany(Usuario::class, 'id', 'id_rol');
    }
}
