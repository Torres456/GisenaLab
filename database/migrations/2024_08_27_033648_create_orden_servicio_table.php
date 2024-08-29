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
        Schema::create('orden_servicio', function (Blueprint $table) {
            $table->id('id_orden_servicio');
            $table->timestamp('fecha_orden')->useCurrent();
            $table->integer('prioridad');
            $table->integer('requiere_factura')->nullable();
            $table->string('inf_adicional')->nullable();
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id_cliente')->on('cliente');
            $table->unsignedBigInteger('id_cotizacion');
            $table->foreign('id_cotizacion')->references('id_cotizacion')->on('cotizacion');
            $table->unsignedBigInteger('id_interesado');
            $table->foreign('id_interesado')->references('id_interesado')->on('interesado');
            $table->string('remision_muestra', 45)->nullable();
            $table->string('tipo_documento', 50)->nullable();
            $table->string('folio_documento', 45)->nullable();
            $table->string('netsuite', 45)->nullable();
            $table->unsignedBigInteger('id_status_orden_servicio');
            $table->foreign('id_status_orden_servicio')->references('id_status_orden_servicio')->on('status_orden_servicio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_servicio');
    }
};
