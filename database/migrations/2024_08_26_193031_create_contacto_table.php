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
        Schema::create('contacto', function (Blueprint $table) {
            $table->id('id_contacto');
            $table->string('nombre', 50);
            $table->string('ap_paterno', 50);
            $table->string('ap_materno', 50);
            $table->string('telefono', 20);
            $table->string('correo', 150)->unique();
            $table->string('telefono_alternativo', 20);
            $table->string('correo_alternativo', 150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacto');
    }
};
