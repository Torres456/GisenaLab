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
        Schema::create('sucursales_gisena', function (Blueprint $table) {
            $table->id('id_sucursal_gisena');
            $table->integer('numero_sucursal')->unique();
            $table->string('nombre', 100)->unique();
            $table->unsignedBigInteger('id_estado');
            $table->foreign('id_estado')->references('id_estado')->on('estado');
            $table->unsignedBigInteger('id_municipio');
            $table->foreign('id_municipio')->references('id_municipio')->on('municipio');
            $table->unsignedBigInteger('id_colonia');
            $table->foreign('id_colonia')->references('id_colonia')->on('colonia');
            $table->string('calle', 100);
            $table->string('no_exterior', 20);
            $table->string('no_interior', 20);
            $table->integer('cp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursales_gisena');
    }
};
