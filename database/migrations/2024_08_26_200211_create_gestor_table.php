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
        Schema::create('gestor', function (Blueprint $table) {
            $table->id('id_gestor');
            $table->string('nombre', 50);
            $table->string('ap_paterno', 50);
            $table->string('ap_materno', 50);
            $table->string('telefono', 20);
            $table->string('correo', 150)->unique();
            $table->integer('sexo');
            $table->unsignedBigInteger('id_direccion');
            $table->foreign('id_direccion')->references('id_direccion')->on('direccion');
            $table->unsignedBigInteger('id_usuario_sistema');
            $table->foreign('id_usuario_sistema')->references('id_usuario_sistema')->on('usuario_sistema');
            $table->unsignedBigInteger('id_zona_representacion');
            $table->foreign('id_zona_representacion')->references('id_zona_representacion')->on('zona_representacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gestor');
    }
};
