<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class Producto extends Model
{
    /**
     * Atributos permitidos
     */
    protected $fillable = ['codigo', 'descripcion', 'cantidad', 'id_tipo_uso', 'id_tipo_vehiculo', 'costo_unitario'];

    /**
     * Retorna el costo total del stock de un producto
     * 
     * @return double $costoTotal
     */
    public function costoTotal(){
        $costoTotal = $this->cantidad * $this->costo_unitario;

        return number_format($costoTotal, 2);
    }

    protected function baseFillable()
    {
        return $this->fillable;
    }
}
