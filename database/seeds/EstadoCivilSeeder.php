<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoCivilSeeder extends Seeder{
    public function run()
    {
        DB::table('estado_civil')->insert([
            [
                'nome'          => 'Solteiro',
            ],
            [
                'nome'          => 'Casado',
            ],
            [
                'nome'          => 'Separado',
            ],
            [
                'nome'          => 'Divorciado',
            ],
            [
                'nome'          => 'Viúvo',
            ],
        ]);
    }
}
