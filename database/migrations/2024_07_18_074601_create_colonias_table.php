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
        Schema::create('colonia', function (Blueprint $table) {
            $table->id('id_colonia');
            $table->string('nombre', 100);
            $table->integer('clave_colonia');
            $table->unsignedBigInteger('id_municipio');
            $table->foreign('id_municipio')->references('id_municipio')->on('municipio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colonia');
    }
};
