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
            $table->unsignedBigInteger('numero_orden_servicio');
            $table->foreign('numero_orden_servicio')->references('numero_orden_servicio')->on('orden_servicio');
            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_categoria')->references('id_categoria')->on('catalogo_categoria');
            $table->unsignedBigInteger('id_subcategoria');
            $table->foreign('id_subcategoria')->references('id_subcategoria')->on('catalogo_subcategoria');
            $table->unsignedBigInteger('id_tipo_muestra');
            $table->foreign('id_tipo_muestra')->references('id_tipo_muestra')->on('catalogo_tipo_muestra');
            $table->unsignedBigInteger('id_descrip_muestra');
            $table->unsignedBigInteger('id_tipo_analisis');
            $table->foreign('id_tipo_analisis')->references('id_tipo_analisis')->on('catalogo_tipo_analisis');
            $table->unsignedBigInteger('id_analisis_especifico');
            $table->foreign('id_analisis_especifico')->references('id_analisis_especifico')->on('catalogo_analisis_especificos');
            $table->integer('cantidad_enviada');
            $table->integer('no_lote');
            $table->string('productor_responsable',100)->nullable(false);
            $table->date('fecha_muestreo')->nullable(false);
            $table->string('otros_datos',250)->nullable(true);
            $table->date('fecha_envio')->nullable(false);
            $table->string('idioma_informe',100)->default('Español');
            $table->unsignedBigInteger('idprocedencia_orden');
            $table->unsignedBigInteger('idmuestra_internacional');
            $table->foreign('idmuestra_internacional')->references('idmuestra_internacional')->on('meustra_internacional');
            $table->integer('tiempo_respuesta');
            $table->unsignedBigInteger('idstatus_muestra');
            $table->foreign('idstatus_muestra')->references('idstatus_muestra')->on('status_muestra');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mustra_orden_servicios');
    }
};
