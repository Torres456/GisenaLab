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
            $table->string('nombre', 100);
            $table->string('ap_paterno', 100);
            $table->string('ap_materno', 100);
            $table->string('telefono', 15);
            $table->string('correo', 100);
            $table->integer('sexo');
            $table->unsignedBigInteger('id_direccion');
            $table->foreign('id_direccion')->references('id_direccion')->on('direccion');
            $table->unsignedBigInteger('idusuario_sistema');
            $table->foreign('idusuario_sistema')->references('idusuario_sistema')->on('usuario_sistema');
            $table->unsignedBigInteger('idzona_representacion');
            $table->foreign('idzona_representacion')->references('idzona_representacion')->on('zona_representacion');
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
