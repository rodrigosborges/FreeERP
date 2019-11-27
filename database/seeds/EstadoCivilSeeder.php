<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoCivilSeeder extends Seeder{
    public function run()
    {
        DB::table('estado_civil')->insert([
            [
                'nome'          => 'Solteiro(a)',
            ],
            [
                'nome'          => 'Casado(a)',
            ],
            [
                'nome'          => 'Separado(a)',
            ],
            [
                'nome'          => 'Divorciado(a)',
            ],
            [
                'nome'          => 'Viúvo(a)',
            ],
        ]);
    }
}
