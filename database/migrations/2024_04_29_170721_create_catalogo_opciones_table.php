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
        Schema::create('catalogo_opciones', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('catalogo_id');
            $table->text('nombre');
            $table->string('valor');
            $table->timestamps();
            $table->foreign('catalogo_id')->references('id')->on('catalogos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogo_opciones');
    }
};
