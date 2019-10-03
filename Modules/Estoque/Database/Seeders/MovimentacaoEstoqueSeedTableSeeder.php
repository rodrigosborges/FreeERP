<?php

namespace Modules\Estoque\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MovimentacaoEstoqueSeedTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('movimentacao_estoque')->insert([
            [
                'estoque_id' => 1,
                'preco_custo' => 50.02,
                'observacao' => 'Esse é o teste 1',
                'quantidade' => 3,
                'created_at' => '2019-06-23 02:32:44'
            ],
            [
                'estoque_id' => 2,
                'preco_custo' => 26.23,
                'observacao' => 'Esse é o teste 2',
                'quantidade' => 4,
                'created_at' => '2019-06-26 02:32:44'
            ],
            [
                'estoque_id' => 3,
                'preco_custo' => 12.48,
                'observacao' => 'Esse é o teste 3',
                'quantidade' => 2,
                'created_at' => '2019-06-25 02:32:44'
            ],
            [
                'estoque_id' => 4,
                'preco_custo' => 36.04,
                'observacao' => 'Esse é o teste 4',
                'quantidade' => 7,
                'created_at' => '2019-06-22 02:32:44'
            ],
            [
                'estoque_id' => 5,
                'preco_custo' => 102.03,
                'observacao' => 'Esse é o teste 5',
                'quantidade' => 10,
                'created_at' => '2019-06-19 02:32:44'
            ]
        ]);
    }
}
