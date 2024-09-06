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
        Schema::create('detalle_cancelacion_orden', function (Blueprint $table) {
            $table->id('id_detalle_cancelacion_orden');
            $table->string('descripcion');
            $table->unsignedBigInteger('id_orden_servicio');
            $table->foreign('id_orden_servicio')->references('id_orden_servicio')->on('orden_servicio');
            $table->integer('estatus')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_cancelacion_orden');
    }
};
