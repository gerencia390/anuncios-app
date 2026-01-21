<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['cat_nombre' => 'VENTA', 'cat_letra_codigo' => 'V', 'cat_descripcion' => 'Venta de inmuebles', 'cat_activo' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_nombre' => 'ALQUILER', 'cat_letra_codigo' => 'AL','cat_descripcion' => 'Alquiler de inmuebles', 'cat_activo' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_nombre' => 'ANTICRETICO', 'cat_letra_codigo' => 'AN', 'cat_descripcion' => 'Anticretico de inmuebles', 'cat_activo' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_nombre' => 'EMPLEOS', 'cat_letra_codigo' => 'E', 'cat_descripcion' => 'Ofertas y búsquedas de empleo', 'cat_activo' => true, 'created_at' => now(), 'updated_at' => now()],
            ['cat_nombre' => 'VARIOS', 'cat_letra_codigo' => 'O', 'cat_descripcion' => 'Otros anuncios', 'cat_activo' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
