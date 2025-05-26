<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloVehiculo extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo
     *
     * @var string
     */
    protected $table = 'modelos_vehiculo';

    /**
     * Atributos permitidos
     *
     * @var array
     */
    protected $fillable = ['nombre', 'id_marca'];

    /**
     * Relación con el modelo MarcaVehiculo
     * 
     * @return MarcaVehiculo
     */
    public function marcaVehiculo() {
        return $this->belongsTo(MarcaVehiculo::class, 'id_marca', 'id');
    }
}
