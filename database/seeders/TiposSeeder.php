<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipos')->insert([
            [
                'tip_nombre' => 'clasificados',
                'tip_descripcion' => 'Anuncios clasificados del público',
                'tip_activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tip_nombre' => 'destacados',
                'tip_descripcion' => 'Anuncios destacados del público',
                'tip_activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tip_nombre' => 'propios',
                'tip_descripcion' => 'Anuncios propios de la empresa',
                'tip_activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
