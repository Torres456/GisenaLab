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
        Schema::create('contenedores_orden_servicio', function (Blueprint $table) {
            $table->id('id_cont_orden_servicio');
            $table->unsignedBigInteger('id_contenedor');
            $table->foreign('id_contenedor')->references('id_contenedor')->on('contenedores');
            $table->unsignedBigInteger('id_orden_servicio');
            $table->foreign('id_orden_servicio')->references('id_orden_servicio')->on('orden_servicio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenedores_orden_servicio');
    }
};
