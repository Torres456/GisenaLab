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

        Schema::create('cliente_direccion', function (Blueprint $table) {
            $table->id('id_cliente_direccion');
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id_cliente')->on('cliente');
            $table->unsignedBigInteger('id_direccion');
            $table->foreign('id_direccion')->references('id_direccion')->on('direccion');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('cliente_direccion');
    }
};
