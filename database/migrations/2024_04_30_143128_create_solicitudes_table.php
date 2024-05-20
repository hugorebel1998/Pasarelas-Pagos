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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('usuario_id');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('fecha_nacimiento');
            $table->string('anio_escolar');
            $table->string('nombre_tutor');
            $table->string('apellidos_tutor');
            $table->string('parentesco');
            $table->string('email');
            $table->string('telefono');
            $table->string('nombre_colegio');
            // $table->decimal('monto_a_pagar',11,2);
            // $table->string('referencia_pago');
            // $table->string('moneda_clave');
            $table->string('ciclo_viaje_clave');
            $table->string('pais_clave');
            $table->string('programa_clave');
            $table->timestamps();
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
