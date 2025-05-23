<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materiales', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('codigo', 10)->unique();
            $table->string('descripcion', 100);
            $table->unsignedSmallInteger('cantidad');
            $table->unsignedSmallInteger('id_marca');
            $table->unsignedSmallInteger('id_modelo');
            $table->unsignedTinyInteger('id_tipo_uso');
            $table->unsignedTinyInteger('id_tipo_vehiculo');
            $table->decimal('costo_unitario', 8, 2);
            $table->timestamps();

            // FK
            $table->foreign('id_tipo_uso')->references('id')->on('tipos_usos');
            $table->foreign('id_tipo_vehiculo')->references('id')->on('tipos_vehiculos');
            $table->foreign('id_marca')->references('id')->on('marcas_vehiculos');
            $table->foreign('id_modelo')->references('id')->on('modelos_vehiculos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiales');
    }
};
