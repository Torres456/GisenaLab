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
        Schema::create('muestra_orden_servicio', function (Blueprint $table) {
            $table->id('id_muestra_orden_servicio');
            $table->unsignedBigInteger('id_orden_servicio');
            $table->foreign('id_orden_servicio')->references('id_orden_servicio')->on('orden_servicio');
            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_categoria')->references('id_categoria')->on('catalogo_categoria');
            $table->unsignedBigInteger('id_subcategoria');
            $table->foreign('id_subcategoria')->references('id_subcategoria')->on('catalogo_subcategoria');
            $table->unsignedBigInteger('id_tipo_muestra');
            $table->foreign('id_tipo_muestra')->references('id_tipo_muestra')->on('catalogo_tipo_muestra');
            $table->unsignedBigInteger('id_descrip_muestra');
            $table->foreign('id_descrip_muestra')->references('id_descrip_muestra')->on('descrip_muestra');
            $table->unsignedBigInteger('id_tipo_analisis');
            $table->foreign('id_tipo_analisis')->references('id_tipo_analisis')->on('catalogo_tipo_analisis');
            $table->unsignedBigInteger('id_analisis_especifico');
            $table->foreign('id_analisis_especifico')->references('id_analisis_especifico')->on('catalogo_analisis_especifico');
            $table->unsignedBigInteger('id_procedencia');
            $table->foreign('id_procedencia')->references('id_procedencia')->on('procedencia');
            $table->double('cantidad_enviada');
            $table->unsignedBigInteger('id_unidad_medida');
            $table->foreign('id_unidad_medida')->references('id_unidad_medida')->on('unidad_medida');
            $table->integer('no_lote');
            $table->string('productor_responsable', 100);
            $table->dateTime('fecha_muestreo');
            $table->string('otros_datos')->nullable();
            $table->dateTime('fecha_envio');
            $table->string('idioma_informe', 3)->default('es');
            $table->unsignedBigInteger('id_procedencia_orden');
            $table->foreign('id_procedencia_orden')->references('id_procedencia_orden')->on('procedencia_orden');
            $table->unsignedBigInteger('id_muestra_internacional')->nullable();
            $table->foreign('id_muestra_internacional')->references('id_muestra_internacional')->on('muestra_internacional');
            $table->integer('tiempo_respuesta');
            $table->unsignedBigInteger('id_status_muestra');
            $table->foreign('id_status_muestra')->references('id_status_muestra')->on('status_muestra');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muestra_orden_servicio');
    }
};
