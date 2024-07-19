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
        Schema::create('direccion', function (Blueprint $table) {
            $table->id('id_direccion');
            $table->string('calle', 100);
            $table->integer('no_exterior');
            $table->integer('no_interior');
            $table->string('entre_calles');
            $table->string('referencia');
            $table->integer('cp');
            $table->unsignedBigInteger('id_estado');
            $table->foreign('id_estado')->references('id_estado')->on('estado');
            $table->unsignedBigInteger('id_municipio');
            $table->foreign('id_municipio')->references('id_municipio')->on('municipio');
            $table->unsignedBigInteger('id_colonia');
            $table->foreign('id_colonia')->references('id_colonia')->on('colonia');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direccion');
    }
};
