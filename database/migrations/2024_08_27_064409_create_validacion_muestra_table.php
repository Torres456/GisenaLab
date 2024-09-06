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
        Schema::create('validacion_muestra', function (Blueprint $table) {
            $table->id('id_validacion_muestra');
            $table->double('temperatura');
            $table->integer('tipo_temperatura');
            $table->double('cantidad_recibida');
            $table->unsignedBigInteger('id_unidad_medida');
            $table->foreign('id_unidad_medida')->references('id_unidad_medida')->on('unidad_medida');
            $table->unsignedBigInteger('id_muestra_orden_servicio');
            $table->foreign('id_muestra_orden_servicio')->references('id_muestra_orden_servicio')->on('muestra_orden_servicio');
            $table->integer('validado');
            $table->string('justificacion');
            $table->integer('prioridad');
            $table->unsignedBigInteger('id_empleado');
            $table->foreign('id_empleado')->references('id_empleado')->on('empleado');
            $table->integer('estatus')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validacion_muestra');
    }
};
