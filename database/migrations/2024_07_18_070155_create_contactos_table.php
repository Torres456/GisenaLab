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
            $table->string('nombre', 100);
            $table->string('ap_paterno', 100);
            $table->string('ap_materno', 100);
            $table->string('telefono', 15);
            $table->string('correo');
            $table->string('telefono_alternativo', 15);
            $table->string('correo_alternativo');
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
