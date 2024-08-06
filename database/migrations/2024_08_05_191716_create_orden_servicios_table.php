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
            $table->id('numero_orden_servicio');
            $table->date('fecha_orden')->useCurrent();
            $table->string('prioridad',10)->nullable(false);
            $table->string('requiere_factura',50)->nullable(true);
            $table->string('inf_adicional',250)->nullable(true);
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id_cliente')->on('cliente');
            $table->unsignedBigInteger('id_cotizacion');
            $table->foreign('id_cotizacion')->references('id_cotizacion')->on('cotizacion');
            $table->unsignedBigInteger('id_interesado');
            $table->foreign('id_interesado')->references('id_interesado')->on('interesado');
            $table->string('remision_muestra',45)->nullable(true);
            $table->string('tipo_documento',45)->nullable(true);
            $table->string('folio_documento',45)->nullable(true);
            $table->string('netsuite',45)->nullable(true);
            $table->unsignedBigInteger('idstatus_orden_servicio');
            $table->foreign('idstatus_orden_servicio')->references('idstatus_orden_servicio')->on('status_orden_servicio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_servicios');
    }
};
