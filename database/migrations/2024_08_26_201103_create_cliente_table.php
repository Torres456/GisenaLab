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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('razon_social')->nullable();
            $table->string('rfc', 13)->unique();
            $table->integer('tipo');
            $table->string('correo', 150)->unique();
            $table->string('telefono', 20)->nullable();
            $table->string('correo_alternativo', 150)->nullable();
            $table->string('telefono_alternativo', 20)->nullable();
            $table->unsignedBigInteger('id_contacto')->nullable();
            $table->foreign('id_contacto')->references('id_contacto')->on('contacto');
            $table->unsignedBigInteger('id_gestor')->nullable();
            $table->foreign('id_gestor')->references('id_gestor')->on('gestor');
            $table->unsignedBigInteger('id_usuario_sistema');
            $table->foreign('id_usuario_sistema')->references('id_usuario_sistema')->on('usuario_sistema');
            $table->integer('estatus')->default(1);
            $table->timestamps();
            $table->unsignedBigInteger('id_regimen_fiscal')->nullable();;
            $table->foreign('id_regimen_fiscal')->references('id_regimen_fiscal')->on('regimen_fiscal');
            $table->unsignedBigInteger('id_uso_cfdi')->nullable();;
            $table->foreign('id_uso_cfdi')->references('id_uso_cfdi')->on('uso_cfdi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
