<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Usuario;
use App\Models\Insumo;
use App\Models\Material;
use App\Models\Maquina;
use App\Models\ModeloVehiculo;
use App\Models\TipoVehiculo;
use App\Models\OrdenTrabajo;

class OrdenTrabajoTest extends TestCase
{
    public function test_validacion_orden_trabajo_vacia()
    {
        $controller = new \App\Http\Controllers\OrdenTrabajoController;

        $data = [];

        $validator = $controller->createValidator($data);
        
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('fecha', $validator->errors()->messages());
        $this->assertArrayHasKey('empresa', $validator->errors()->messages());
        $this->assertArrayHasKey('minutos_trabajo', $validator->errors()->messages());
        $this->assertArrayHasKey('patente', $validator->errors()->messages());
        $this->assertArrayHasKey('id_modelo_vehiculo', $validator->errors()->messages());
        $this->assertArrayHasKey('id_tipo_vehiculo', $validator->errors()->messages());
        $this->assertArrayHasKey('trabajo_realizado', $validator->errors()->messages());
        $this->assertArrayHasKey('id_usuario', $validator->errors()->messages());
    }

    public function test_validacion_orden_trabajo_valida()
    {
        $controller = new \App\Http\Controllers\OrdenTrabajoController;

        $data = [
            'fecha' => now()->format('Y-m-d'),
            'empresa' => 'Test S.A.',
            'minutos_trabajo' => 30,
            'patente' => 'ZZ123ZZ',
            'id_modelo_vehiculo' => 1,
            'id_tipo_vehiculo' => 1,
            'id_usuario' => 1,
            'trabajo_realizado_1' => 1,
            'trabajo_realizado_2' => 0,
            'trabajo_realizado_3' => 0,
            'trabajo_realizado_4' => 0,
        ];

        $validator = $controller->createValidator($data);
        
        $this->assertTrue(!$validator->fails());
    }
}
