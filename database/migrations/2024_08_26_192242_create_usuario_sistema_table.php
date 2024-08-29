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
        Schema::create('usuario_sistema', function (Blueprint $table) {
            $table->id('id_usuario_sistema');
            $table->string('nombre', 50);
            $table->string('ap_paterno', 50);
            $table->string('ap_materno', 50);
            $table->string('correo', 150)->unique();
            $table->string('contraseña');
            $table->integer('estatus');
            $table->unsignedBigInteger('id_tipo_usuario');
            $table->foreign('id_tipo_usuario')->references('id_tipo_usuario')->on('tipo_usuario');
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
            $table->foreign('user_id')->references('id_usuario_sistema')->on('usuario_sistema');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('usuario_sistema');
    }
};
