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
        Schema::create('detalle_espeicifico_mos', function (Blueprint $table) {
            $table->id('id_detalle_espeicifico_mos');
            $table->unsignedBigInteger('id_muestra_orden_servicio');
            $table->foreign('id_muestra_orden_servicio')->references('id_muestra_orden_servicio')->on('muestra_orden_servicio');
            $table->unsignedBigInteger('id_datos_muestra_especificos');
            $table->foreign('id_datos_muestra_especificos')->references('id_datos_muestra_especificos')->on('datos_muestra_especificos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_espeicifico_mos');
    }
};
