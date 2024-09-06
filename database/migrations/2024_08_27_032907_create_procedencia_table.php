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
        Schema::create('procedencia', function (Blueprint $table) {
            $table->id('id_procedencia');
            $table->string('sitio_muestreo', 150);
            $table->string('nombre_sitio_muestreo', 150);
            $table->unsignedBigInteger('id_estado');
            $table->foreign('id_estado')->references('id_estado')->on('estado');
            $table->unsignedBigInteger('id_municipio');
            $table->foreign('id_municipio')->references('id_municipio')->on('municipio');
            $table->unsignedBigInteger('id_colonia');
            $table->foreign('id_colonia')->references('id_colonia')->on('colonia');
            $table->string('calle', 100);
            $table->string('num_exterior', 20);
            $table->string('num_interior', 20);
            $table->integer('cp');
            $table->string('gps', 100);
            $table->string('registro_sader', 20);
            $table->integer('estatus')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedencia');
    }
};
