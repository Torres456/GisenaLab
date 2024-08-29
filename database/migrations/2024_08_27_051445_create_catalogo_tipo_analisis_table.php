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
        Schema::create('catalogo_tipo_analisis', function (Blueprint $table) {
            $table->id('id_tipo_analisis');
            $table->string('nomb_tipo_analisis', 100)->unique();
            $table->string('clave', 45)->unique();
            $table->unsignedBigInteger('id_tipo_muestra');
            $table->foreign('id_tipo_muestra')->references('id_tipo_muestra')->on('catalogo_tipo_muestra');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogo_tipo_analisis');
    }
};
