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
        Schema::create('interesado', function (Blueprint $table) {
            $table->id('id_interesado');
            $table->string('nombre', 50);
            $table->string('ap_paterno', 50);
            $table->string('ap_materno', 50);
            $table->string('telefono', 20);
            $table->string('correo', 150)->unique();
            $table->string('telefono_alternativo', 20);
            $table->string('correo_alternativo', 150);
            $table->unsignedBigInteger('id_contacto');
            $table->foreign('id_contacto')->references('id_contacto')->on('contacto');
            $table->unsignedBigInteger('id_gestor');
            $table->foreign('id_gestor')->references('id_gestor')->on('gestor');
            $table->unsignedBigInteger('id_direccion');
            $table->foreign('id_direccion')->references('id_direccion')->on('direccion');
            $table->unsignedBigInteger('id_usuario_sistema');
            $table->foreign('id_usuario_sistema')->references('id_usuario_sistema')->on('usuario_sistema');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interesado');
    }
};
