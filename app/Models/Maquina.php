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

    /**
     * Relación con el modelo OrdenTrabajo
     * 
     * @return array (OrdenTrabajo)
     */
    public function ordenesTrabajo() {
        return $this->belongsToMany(OrdenTrabajo::class, 'ordenes_trabajo_maquinas', 'id_orden_trabajo', 'id_maquina')
                    ->withPivot('minutos_uso', 'cambio_combustible');
    }
}
