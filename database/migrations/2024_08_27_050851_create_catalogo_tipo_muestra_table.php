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
        Schema::create('catalogo_tipo_muestra', function (Blueprint $table) {

            $table->id('id_tipo_muestra');
            $table->string('nom_tipo_muestra', 100)->unique();
            $table->string('caracteristicas', 100);
            $table->double('cantidad_requerida');
            $table->unsignedBigInteger('id_subcategoria');
            $table->foreign('id_subcategoria')->references('id_subcategoria')->on('catalogo_subcategoria');
            $table->unsignedBigInteger('id_unidad_medida');
            $table->foreign('id_unidad_medida')->references('id_unidad_medida')->on('unidad_medida');
            $table->unsignedBigInteger('id_unidad_metodo');
            $table->foreign('id_unidad_metodo')->references('id_unidad_metodo')->on('unidad_metodo');
            $table->integer('estatus')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogo_tipo_muestra');
    }
};
