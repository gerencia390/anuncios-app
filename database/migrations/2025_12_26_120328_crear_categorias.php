<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->Increments('cat_id');
            $table->string('cat_nombre')->unique();
            $table->string('cat_descripcion')->nullable();
            $table->string('cat_letra_codigo', 3); 
            $table->boolean('cat_activo')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
