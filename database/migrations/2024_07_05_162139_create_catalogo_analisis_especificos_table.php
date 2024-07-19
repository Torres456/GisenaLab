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
        Schema::create('catalogo_analisis_especificos', function (Blueprint $table) {
            $table->id('id_analisis_especifico');
            $table->string('nombre_comercial_analisis_especifico', 50);
            $table->string('descripcion', 250);
            $table->unsignedBigInteger('id_tipo_analisis');
            $table->foreign('id_tipo_analisis')->references('id_tipo_analisis')->on('catalogo_tipo_analisis');
            $table->string('clave_analisis', 45);
            $table->string('acreditacion', 45);
            $table->string('nombre_tecnico', 45);
            $table->string('referencia_normativa', 45);
            $table->string('aprobacion', 45)->nullable();
            $table->string('autorizacion', 45)->nullable();
            $table->double('precio_ordinario');
            $table->double('precio_urgente');
            $table->string('tiempo_respuesta_urgente',45);
            $table->string('tiempo_respuesta_ordinario',45);
            $table->string('capacidad_instalada',45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogo_analisis_especificos');
    }
};
