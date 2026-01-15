<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnunciosSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = DB::table('tipos')->get();
        $categorias = DB::table('categorias')->pluck('cat_id');
        $usuarios = DB::table('usuarios')->pluck('usu_id');

        $year = Carbon::now()->year;
        $contador = [
            'P' => 1,
            'C' => 1
        ];

        for ($i = 1; $i <= 30; $i++) {

            $tipo = $tipos->random();
            $letra = $tipo->tip_letra_codigo;

            $codigo = sprintf(
                '%s-%06d-%d',
                $letra,
                $contador[$letra],
                $year
            );

            $contador[$letra]++;

            DB::table('anuncios')->insert([
                'usu_id' => $usuarios->random(),
                'tip_id' => $tipo->tip_id,
                'cat_id' => $categorias->random(),
                'anu_codigo_anuncio' => $codigo,
                'anu_titulo' => "Anuncio de prueba #{$i}",
                'anu_descripcion' => "Descripción del anuncio número {$i}. Contenido de ejemplo para pruebas del letrero digital.",
                'anu_imagen_url' => null,
                'anu_video_url' => null,
                'anu_prioridad' => rand(1, 5),
                'anu_fecha_inicio' => now()->subDays(rand(0, 5)),
                'anu_fecha_vencimiento' => now()->addDays(rand(10, 60)),
                'anu_nombre_contacto' => "Contacto {$i}",
                'anu_documento_identidad' => "CI-" . rand(1000000, 9999999),
                'anu_telefonos_contacto' => '70123456, 76543210',
                'anu_direccion' => 'Zona Central',
                'anu_ubicacion' => 'Cerca a plaza principal',
                'anu_activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
