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
        Schema::create('descrip_muestra', function (Blueprint $table) {
            $table->id('id_descrip_muestra');
            $table->string('nombre_descrip', 100);
            $table->unsignedBigInteger('id_tipo_muestra');
            $table->foreign('id_tipo_muestra')->references('id_tipo_muestra')->on('catalogo_tipo_muestra');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descrip_muestra');
    }
};
