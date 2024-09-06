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
        Schema::create('muestra_internacional', function (Blueprint $table) {
            $table->id('id_muestra_internacional');
            $table->timestamp('fecha_recepcion')->useCurrent();
            $table->string('sucursal', 45);
            $table->integer('prioridad');
            $table->string('oficina_inspeccion', 45);
            $table->string('numero_pedimiento', 45);
            $table->string('numero_remision', 45);
            $table->string('numero_sinalab', 45);
            $table->string('nombre_importador');
            $table->string('requisitos', 45);
            $table->string('origen_procedencia', 45);
            $table->string('ci', 45);
            $table->string('fraccion', 45);
            $table->string('otros_datos', 45);
            $table->unsignedBigInteger('id_direccion');
            $table->foreign('id_direccion')->references('id_direccion')->on('direccion');
            $table->integer('estatus')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muestra_internacional');
    }
};
