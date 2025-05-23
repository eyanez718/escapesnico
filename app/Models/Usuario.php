<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    /**
     * Tabla asociada al modelo
     *
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * Atributos permitidos
     *
     * @var array
     */
    protected $fillable = ['nombre', 'nombre_completo', 'contrasenia', 'email', 'id_rol'];

    /**
     * Atributos ocultos para los arrays
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',  'contrasenia', 
    ];

    /**
     * Redefinición del atributo password
     * 
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->contrasenia;
    }

    /**
     * Rol asociado al usuario
     * 
     * @return Rol
     */
    public function rol() {
        return $this->belongsTo(Rol::class, 'id_rol', 'id');
    }
}
