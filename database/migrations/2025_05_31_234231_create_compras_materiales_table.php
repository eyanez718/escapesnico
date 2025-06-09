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
        Schema::create('compras_materiales', function (Blueprint $table) {
            $table->unsignedSmallInteger('id_compra');
            $table->unsignedSmallInteger('id_material');
            $table->unsignedSmallInteger('cantidad');
            $table->decimal('costo_unitario', 8, 2);

            //PK
            $table->primary(['id_compra', 'id_material']);
            //FK
            $table->foreign('id_compra')->references('id')->on('compras');
            $table->foreign('id_material')->references('id')->on('materiales');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras_materiales');
    }
};
