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
        Schema::create('modelos_vehiculo', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('nombre', 20)->unique();
            $table->unsignedSmallInteger('id_marca');
            $table->timestamps();

            // FK
            $table->foreign('id_marca')->references('id')->on('marcas_vehiculos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modelos_vehiculo');
    }
};
