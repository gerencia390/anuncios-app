<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('anuncios', function (Blueprint $table) {
            $table->Increments('anu_id');
            $table->integer('tip_id')->unsigned()->default(1); // 1=clasificados, 2=destacados, 3=propios
            $table->integer('cat_id')->unsigned();
            $table->integer('usu_id')->unsigned()->default(1); // usuario que creó el anuncio

            // Código correlativo
            $table->string('anu_codigo_anuncio')->unique(); 

            // Contenido
            $table->string('anu_concepto');                       //concepto
            $table->text('anu_descripcion')->nullable();        //descripcion
            // Multimedia
            $table->string('anu_imagen_url')->nullable();       // imagen principal
            $table->string('anu_video_url')->nullable();        // video opcional
            // Control
            $table->integer('anu_prioridad')->default(0);
            // Fechas
            $table->date('anu_fecha_inicio');                   //fecha de publicación
            $table->date('anu_fecha_vencimiento')->nullable();          //fecha de vencimiento (calculado por sistema)
            // Contacto
            $table->string('anu_cliente');              //CLIENTE
            $table->string('anu_nit_ci');          //NRO CI
            $table->string('anu_telefonos_contacto');       //TELÉFONOS
            $table->string('anu_ubicacion')->nullable();    // UBICACIÓN
            $table->string('anu_precio_sueldo')->nullable();    // PRECIO/SUELDO
            $table->float('anu_monto_pago')->nullable();      //DIRECCIÓN
            $table->string('anu_nro_factura')->nullable();     //NRO DE RECIBO
            // Estado
            $table->integer('anu_estado')->default(0);// 0=guardado, 1=publicado, 2=finalizado

            // Laravel timestamps
            $table->timestamps();
            // Relaciones
            $table->foreign('tip_id')->references('tip_id')->on('tipos');
            $table->foreign('cat_id')->references('cat_id')->on('categorias');
            $table->foreign('usu_id')->references('usu_id')->on('usuarios');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anuncios');
    }
};
