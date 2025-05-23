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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('nombre', 20);
            $table->string('nombre', 50);
            $table->string('email')->unique();
            $table->string('contrasenia');
            $table->unsignedTinyInteger('id_rol');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // FK
            $table->foreign('id_rol')->references('id')->on('roles');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
