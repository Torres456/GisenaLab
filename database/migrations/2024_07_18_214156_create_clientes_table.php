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
            $table->string('razon_social',200);
            $table->string('rfc',15);
            $table->string('regimen_fiscal',4)->nullable();
            $table->string('uso_cfdi',5)->nullable();
            $table->integer('tipo')->nullable();
            $table->string('correo',100);
            $table->string('telefono',15)->nullable();
            $table->string('correo_alternativo')->nullable();
            $table->string('telefono_alternativo',15)->nullable();
            $table->unsignedBigInteger('id_contacto')->nullable();
            $table->foreign('id_contacto')->references('id_contacto')->on('contacto');
            $table->unsignedBigInteger('id_gestor')->nullable();
            $table->foreign('id_gestor')->references('id_gestor')->on('gestor');
            $table->unsignedBigInteger('idusuario_sistema');
            $table->foreign('idusuario_sistema')->references('idusuario_sistema')->on('usuario_sistema');
            $table->timestamps();
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
