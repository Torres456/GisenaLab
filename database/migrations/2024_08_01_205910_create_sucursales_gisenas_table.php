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
            $table->id('idsucursal_gisena');
            $table->integer('numero_sucursal')->unique()->nullable(false);
            $table->string('nombre', 100)->nullable(false);
            $table->unsignedBigInteger('id_estado');
            $table->foreign('id_estado')->references('id_estado')->on('estado');
            $table->unsignedBigInteger('id_municipio');
            $table->foreign('id_municipio')->references('id_municipio')->on('municipio');
            $table->unsignedBigInteger('id_colonia');
            $table->foreign('id_colonia')->references('id_colonia')->on('colonia');
            $table->string('calle', 255);
            $table->integer('num_exterior')->nullable(true);
            $table->integer('num_interior')->nullable(true);
            $table->integer('cp')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursales_gisenas');
    }
};
