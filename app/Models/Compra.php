<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo
     *
     * @var string
     */
    protected $table = 'compras';

    /**
     * Atributos permitidos
     *
     * @var array
     */
    protected $fillable = ['id', 'fecha', 'numero_factura', 'id_proveedor', 'id_usuario'];

    /**
     * Relación con el modelo Insumo
     * 
     * @return array (Insumo)
     */
    public function insumos() {
        return $this->belongsToMany(Insumo::class, 'compras_insumos', 'id_compra', 'id_insumo')
                    ->withPivot('cantidad', 'costo_unitario');
    }

    /**
     * Relación con el modelo Material
     * 
     * @return array (Material)
     */
    public function materiales() {
        return $this->belongsToMany(Material::class, 'compras_materiales', 'id_compra', 'id_material')
                    ->withPivot('cantidad', 'costo_unitario');
    }

    /**
     * Relación con el modelo Proveedor
     * 
     * @return Proveedor
     */
    public function proveedor() {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id');
    }

    /**
     * Relación con el modelo Usuario
     * 
     * @return Usuario
     */
    public function usuario() {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id');
    }
}
