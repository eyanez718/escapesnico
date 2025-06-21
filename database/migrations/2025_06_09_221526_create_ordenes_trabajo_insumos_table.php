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
        Schema::create('ordenes_trabajo_insumos', function (Blueprint $table) {
            $table->unsignedSmallInteger('id_orden_trabajo');
            $table->unsignedSmallInteger('id_insumo');
            $table->unsignedSmallInteger('cantidad');

            //PK
            $table->primary(['id_orden_trabajo', 'id_insumo']);
            //FK
            $table->foreign('id_orden_trabajo')->references('id')->on('ordenes_trabajo');
            $table->foreign('id_insumo')->references('id')->on('insumos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes_trabajo_insumos');
    }
};
