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
        Schema::create('detalle_contenedor_muestra', function (Blueprint $table) {
            $table->id('id_detalle_cont_muestra');
            $table->unsignedBigInteger('id_recipiente');
            $table->foreign('id_recipiente')->references('id_recipiente')->on('recipientes');
            $table->unsignedBigInteger('id_cont_orden_servicio');
            $table->foreign('id_cont_orden_servicio')->references('id_cont_orden_servicio')->on('contenedores_orden_servicio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_contenedor_muestra');
    }
};
