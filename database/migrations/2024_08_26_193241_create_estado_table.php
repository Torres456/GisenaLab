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
        Schema::create('estado', function (Blueprint $table) {
            $table->id('id_estado');
            $table->string('nombre', 50)->unique();
            $table->string('clave_estado', 10)->unique();
            $table->unsignedBigInteger('id_pais');
            $table->foreign('id_pais')->references('id_pais')->on('pais');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado');
    }
};
