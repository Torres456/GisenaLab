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
        Schema::create('empleado', function (Blueprint $table) {
            $table->id('id_empleado');
            $table->string('nombre', 50);
            $table->string('ap_paterno', 50);
            $table->string('ap_materno', 50);
            $table->integer('no_empleado');
            $table->string('telefono', 20);
            $table->string('curp', 18)->unique();
            $table->string('rfc', 13)->unique();
            $table->integer('sexo');
            $table->string('calle', 100);
            $table->string('no_exterior', 20);
            $table->string('no_interior', 20);
            $table->integer('cp');
            $table->unsignedBigInteger('id_tipo_empleado');
            $table->foreign('id_tipo_empleado')->references('id_tipo_empleado')->on('tipo_empleado');
            $table->unsignedBigInteger('id_usuario_sistema');
            $table->foreign('id_usuario_sistema')->references('id_usuario_sistema')->on('usuario_sistema');
            $table->unsignedBigInteger('id_estado');
            $table->foreign('id_estado')->references('id_estado')->on('estado');
            $table->unsignedBigInteger('id_municipio');
            $table->foreign('id_municipio')->references('id_municipio')->on('municipio');
            $table->unsignedBigInteger('id_colonia');
            $table->foreign('id_colonia')->references('id_colonia')->on('colonia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado');
    }
};
