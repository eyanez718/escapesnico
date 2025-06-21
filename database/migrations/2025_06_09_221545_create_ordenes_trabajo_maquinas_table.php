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
        Schema::create('ordenes_trabajo_maquinas', function (Blueprint $table) {
            $table->unsignedSmallInteger('id_orden_trabajo');
            $table->unsignedTinyInteger('id_maquina');
            $table->unsignedTinyInteger('minutos_uso');
            $table->boolean('cambio_combustible');

            //PK
            $table->primary(['id_orden_trabajo', 'id_maquina']);
            //FK
            $table->foreign('id_orden_trabajo')->references('id')->on('ordenes_trabajo');
            $table->foreign('id_maquina')->references('id')->on('maquinas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes_trabajo_maquinas');
    }
};
