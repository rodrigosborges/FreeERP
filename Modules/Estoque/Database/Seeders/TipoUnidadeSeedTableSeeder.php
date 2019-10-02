<?php

use Illuminate\Database\Seeder;

class TipoUnidadeSeedTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipo_unidade')->insert([
        [
            'nome' => 'teste1',
            'quantidade_itens' => 10
        ],
        [
            'nome' => 'teste2',
            'quantidade_itens' => 13
        ],
        [
            'nome' => 'teste3',
            'quantidade_itens' => 15
        ],
        [
            'nome' => 'teste4',
            'quantidade_itens' => 8
        ],
        [
            'nome' => 'teste5',
            'quantidade_itens' => 20
        ],
        ]);

    }
}
