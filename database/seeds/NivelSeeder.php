<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nivel')->insert([
            ['descricao' => 'participante'],
            ['descricao' => 'organizador'],
            ['descricao' => 'administrador'],
        ]);
    }
}