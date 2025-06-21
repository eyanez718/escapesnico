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
    protected $fillable = ['id', 'nombre', 'descripcion', 'email'];

    /**
     * Relación con el modelo Compra
     * 
     * @return array (Compras)
     */
    public function compras() {
        return $this->hasMany(Compra::class, 'id_proveedor', 'id');
    }
}
