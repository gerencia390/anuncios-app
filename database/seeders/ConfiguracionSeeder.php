<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert(['key' => "precio_clasificados", 'value' => "15"]);
        DB::table('settings')->insert(['key' => "precio_destacados", 'value' => "20"]);
        DB::table('settings')->insert(['key' => "meses_plazo", 'value' => "2"]);
        DB::table('settings')->insert(['key' => "meses_contrato", 'value' => "3"]);
        DB::table('settings')->insert(['key' => "max_letras_descripcion", 'value' => "50"]);
        DB::table('settings')->insert(['key' => "max_letras_concepto", 'value' => "30"]);
    }
}
