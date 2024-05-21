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
        Schema::create('pagos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('solicitud_id')->nullable();
            $table->string('pasarela_pago')->nullable();
            $table->string('orden_id')->nullable();
            $table->string('pago_id')->nullable();
            $table->string('tipo_moneda')->nullable();
            $table->string('cantidad_pagada')->nullable();
            $table->string('estatus')->nullable();
            $table->string('nombre_pagador')->nullable();
            $table->string('email_pagador')->nullable();
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
