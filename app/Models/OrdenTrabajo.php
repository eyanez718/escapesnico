<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenTrabajo extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo
     *
     * @var string
     */
    protected $table = 'ordenes_trabajo';

    /**
     * Atributos permitidos
     *
     * @var array
     */
    protected $fillable = ['id', 'fecha', 'id_usuario', 'id_modelo_vehiculo', 'id_tipo_vehiculo', 'empresa', 'patente', 'trabajo_realizado_1', 'trabajo_realizado_2', 'trabajo_realizado_3', 'trabajo_realizado_4'];

    /**
     * Relación con el modelo Insumo
     * 
     * @return array (Insumo)
     */
    public function insumos() {
        return $this->belongsToMany(Insumo::class, 'ordenes_trabajo_insumos', 'id_orden_trabajo', 'id_insumo')
                    ->withPivot('cantidad');
    }

    /**
     * Relación con el modelo Material
     * 
     * @return array (Material)
     */
    public function materiales() {
        return $this->belongsToMany(Material::class, 'ordenes_trabajo_materiales', 'id_orden_trabajo', 'id_material')
                    ->withPivot('cantidad');
    }

    /**
     * Relación con el modelo Maquina
     * 
     * @return array (Maquina)
     */
    public function maquinas() {
        return $this->belongsToMany(Maquina::class, 'ordenes_trabajo_maquinas', 'id_orden_trabajo', 'id_maquina')
                    ->withPivot('minutos_uso', 'cambio_combustible');
    }

    /**
     * Relación con el modelo Usuario
     * 
     * @return Usuario
     */
    public function usuario() {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id');
    }

    /**
     * Relación con el modelo ModeloVehiculo
     * 
     * @return ModeloVehiculo
     */
    public function modeloVehiculo() {
        return $this->belongsTo(ModeloVehiculo::class, 'id_modelo_vehiculo', 'id');
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
