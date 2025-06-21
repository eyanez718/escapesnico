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
        Schema::create('ordenes_trabajo', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->date('fecha');
            $table->unsignedSmallInteger('id_usuario');
            $table->unsignedSmallInteger('id_modelo_vehiculo');
            $table->unsignedTinyInteger('id_tipo_vehiculo');
            $table->string('empresa', 20);
            $table->string('patente', 20);
            $table->timestamps();

            //FK
            $table->foreign('id_usuario')->references('id')->on('usuarios');
            $table->foreign('id_modelo_vehiculo')->references('id')->on('modelos_vehiculo');
            $table->foreign('id_tipo_vehiculo')->references('id')->on('tipos_vehiculo');
        });
    }
    // TODO migración ordenes
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes_trabajo');
    }
};
