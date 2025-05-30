<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

class Material extends Producto
{
    use HasFactory;

    /**
     * Tabla asociada al modelo
     * 
     * @var string
     */
    protected $table = 'materiales';

    /**
     * Atributos permitidos
     * Heredado de la clase Producto
     * 
     * @var array
     */
    protected $fillable = [];
    
    /**
     * Retorna $fillable
     * 
     * @return array $fillable
     */
    public function getFillable()
    {
        return array_merge(parent::getFillable(), ['id_marca', 'id_modelo']);
    }

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

    /**
     * Relación con el modelo MarcaVehiculo
     * 
     * @return MarcaVehiculo
     */
    public function marcaVehiculo() {
        return $this->belongsTo(MarcaVehiculo::class, 'id_marca', 'id');
    }

    /**
     * Relación con el modelo ModeloVehiculo
     * 
     * @return ModeloVehiculo
     */
    public function modeloVehiculo() {
        return $this->belongsTo(ModeloVehiculo::class, 'id_modelo', 'id');
    }
}
