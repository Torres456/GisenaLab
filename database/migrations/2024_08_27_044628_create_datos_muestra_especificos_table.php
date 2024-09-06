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
        Schema::create('datos_muestra_especificos', function (Blueprint $table) {
            $table->id('id_datos_muestra_especificos');
            $table->string('descripcion_dato', 200);
            $table->unsignedBigInteger('id_laboratorio');
            $table->foreign('id_laboratorio')->references('id_laboratorio')->on('laboratorios');
            $table->integer('estatus')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_muestra_especificos');
    }
};
