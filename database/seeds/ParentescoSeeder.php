<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParentescoSeeder extends Seeder{
    public function run()
    {
        DB::table('parentesco')->insert([
            [
                'nome'  => 'Pai',
            ],
            [
                'nome'  => 'Mãe',
            ],
            [
                'nome'  => 'Filho(a)',
            ],
            [
                'nome'  => 'Neto(a)',
            ],
            [
                'nome'  => 'Cônjuge',
            ],
            [
                'nome'  => 'Sobrinho(a)',
            ],
            [
                'nome'  => 'Outro',
            ],
        ]);
    }
}
