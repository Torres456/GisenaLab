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
        Schema::create('estados_zona', function (Blueprint $table) {
            $table->id('id_estados_zona');
            $table->unsignedBigInteger('id_estado');
            $table->foreign('id_estado')->references('id_estado')->on('estado');
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
        Schema::dropIfExists('estados_zona');
    }
};
