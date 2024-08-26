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
            $table->string('nombre',50)->nullable(false);
            $table->string('a_paterno',50)->nullable(false);
            $table->string('a_materno',50)->nullable(false);
            $table->string('telefono',12)->nullable(false);
            $table->string('correo',100)->nullable(false);
            $table->string('telefono_alternativo',12)->nullable(false);
            $table->string('correo_alternativo',100)->nullable(false);
            $table->unsignedBigInteger('contacto_idcontacto');
            $table->foreign('contacto_idcontacto')->references('id_contacto')->on('contacto');
            $table->unsignedBigInteger('gestor_id_gestor');
            $table->foreign('gestor_id_gestor')->references('id_gestor')->on('gestor');
            $table->unsignedBigInteger('direccion_id_direccion');
            $table->foreign('direccion_id_direccion')->references('id_direccion')->on('direccion');
            $table->unsignedBigInteger('idusuario_sistema')->nullable(true);
            $table->foreign('idusuario_sistema')->references('idusuario_sistema')->on('usuario_sistema');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interesados');
    }
};
