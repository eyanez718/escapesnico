<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUso extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo
     *
     * @var string
     */
    protected $table = 'tipos_uso';

    /**
     * Atributos permitidos
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * Relación con el modelo Insumo
     * 
     * @return array(Insumo)
     */
    public function insumos()
    {
        return $this->hasMany(Insumo::class, 'id', 'id_tipo_uso');
    }

    /**
     * Relación con el modelo Material
     * 
     * @return array(Material)
     */
    public function materiales()
    {
        return $this->hasMany(Material::class, 'id', 'id_tipo_uso');
    }
}
