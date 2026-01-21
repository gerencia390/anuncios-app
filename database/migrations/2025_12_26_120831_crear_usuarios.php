<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->Increments('usu_id');
            $table->tinyInteger('usu_rol'); // 1 = admin, 2 = publicador, 3=gerencia
            $table->string('usu_nombre')->unique();
            $table->string('password');
            $table->string('usu_nombre_completo');
            $table->boolean('usu_estado')->default(1); // 1 activo, 0 inactivo
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
