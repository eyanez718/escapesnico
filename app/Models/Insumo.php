<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

class Insumo extends Producto
{
    use HasFactory;

    /**
     * Tabla asociada al modelo
     * 
     * @var string
     */
    protected $table = 'insumos';

    /**
     * Atributos permitidos
     * Heredado de la clase Producto
     * 
     * @var array
     */
    //protected $fillable = [];
    
    /**
     * Constructor de clase
     * 
     * @param array $attributes
     */
    /*public function __construct(array $attributes = [])
    {
        $this->fillable = array_merge($this->baseFillable());

        parent::__construct($attributes);
    }*/

    /**
     * Relación con el modelo TipoUso
     * 
     * @return TipoUso
     */
    public function tipoUso() {
        return $this->belongsTo(TipoUso::class, 'id_tipo_uso', 'id');
    }

    /**
     * Relación con el modelo TipoVehiculo
     * 
     * @return TipoVehiculo
     */
    public function tipoVehiculo() {
        return $this->belongsTo(TipoVehiculo::class, 'id_tipo_vehiculo', 'id');
    }
}
