<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::create('usuario_sistema', function (Blueprint $table) {
            $table->id('idusuario_sistema');
            $table->string('correo')->unique();
            $table->string('contraseña');
            $table->integer('estatus')->index();
            $table->unsignedBigInteger('idtipo_usuario');
            $table->foreign('idtipo_usuario')->references('idtipo_usuario')->on('tipo_usuario');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('correo')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });



        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('idusuario_sistema')->on('usuario_sistema');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('usuario_sistema');

    }
};
