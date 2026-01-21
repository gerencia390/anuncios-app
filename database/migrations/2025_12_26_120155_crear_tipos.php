<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tipos', function (Blueprint $table) {
            $table->Increments('tip_id');
            $table->string('tip_nombre')->unique(); // propios, clasificados
            $table->string('tip_descripcion')->nullable();
            $table->boolean('tip_activo')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipos');
    }
};
