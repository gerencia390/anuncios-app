<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert(['usu_nombre' => "admin",'password' => '$2a$10$400g91r/cPjBKIDFxxCQqe1t73cYTSpMZuFVBwFaP3.fuudFpfwH6','usu_nombre_completo' => 'Administrador sys', 'usu_rol' => 1,'usu_estado' => 1, 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
    }
}
