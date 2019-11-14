<?php

namespace Modules\Recrutamento\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class EtapaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('etapa')->insert([
            'nome' => 'Entrevista em Grupo',
            'descricao' => '...'
        ]);
        DB::table('etapa')->insert([
            'nome' => 'Entrevista Individual ',
            'descricao' => '...'
        ]);
        DB::table('etapa')->insert([
            'nome' => 'Prova Prática',
            'descricao' => '...'
        ]);
        DB::table('etapa')->insert([
            'nome' => 'Prova Teórica',
            'descricao' => '...'
        ]);
        DB::table('etapa')->insert([
            'nome' => 'Exame Psicotécnico',
            'descricao' => '...'
        ]);
        Model::unguard();
    }
}
