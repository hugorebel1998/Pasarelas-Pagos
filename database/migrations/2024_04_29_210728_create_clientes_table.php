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
        Schema::create('clientes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre');
            $table->string('paterno');
            $table->string('materno');
            $table->string('email')->unique();
            $table->string('fecha_nacimiento');
            $table->string('nombre_tutor');
            $table->string('apellidos_tutor');
            $table->string('parentesco');
            $table->string('telefono');
            $table->string('estatus');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
