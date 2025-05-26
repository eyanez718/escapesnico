<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaVehiculo extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo
     *
     * @var string
     */
    protected $table = 'marcas_vehiculo';

    /**
     * Atributos permitidos
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * Relación con el modelo ModelVehiculo
     * 
     * @return array (ModeloVehiculo)
     */
    public function modelosVehiculo() {
        return $this->hasMany(ModeloVehiculo::class, 'id', 'id_marca');
    }
}
