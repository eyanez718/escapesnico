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
        Schema::create('compras', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->date('fecha');
            $table->string('numero_factura', 16)->unique();
            $table->unsignedSmallInteger('id_proveedor');
            $table->unsignedSmallInteger('id_usuario');
            $table->timestamps();

            //FK
            $table->foreign('id_proveedor')->references('id')->on('proveedores');
            $table->foreign('id_usuario')->references('id')->on('usuarios');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
