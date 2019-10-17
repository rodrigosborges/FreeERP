<?php

namespace Modules\Estoque\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProdutoSeedTableSeeder extends Seeder{
    public function run()
    {
            DB::table('produto')->insert([
                [
                    'nome'          => 'ProdutoTeste1',
                    'descricao'     => 'Produto de testes 1',
                    'categoria_id'  => '1',
                    'preco'         => '10',
                    'codigo'        => '4548546585',
                    'created_at'    => '2019-08-23 02:32:44'
                ],
                [
                    'nome'          => 'ProdutoTeste2',
                    'descricao'     => 'Produto de testes 2',
                    'categoria_id'  => '2',
                    'preco'         => '20',
                    'codigo'        => '8548546585',
                    'created_at'    => '2019-08-22 02:32:44'
                ],
                [
                    'nome'          => 'ProdutoTeste3',
                    'descricao'     => 'Produto de testes 3',
                    'categoria_id'  => '3',
                    'preco'         => '30',
                    'codigo'        => '9548546585',
                    'created_at'    => '2019-08-21 02:32:50'
                ],
                [
                    'nome'          => 'ProdutoTeste4',
                    'descricao'     => 'Produto de testes 4',
                    'categoria_id'  => '4',
                    'preco'         => '40',
                    'codigo'        => '1548546585',
                    'created_at'    => '2019-08-20 02:32:50'
                ],
                [
                    'nome'          => 'ProdutoTeste5',
                    'descricao'     => 'Produto de testes 5',
                    'categoria_id'  => '5',
                    'preco'         => '50',
                    'codigo'        => '6548546585',
                    'created_at'    => '2019-08-15 02:32:50'
                ],
            ]);
        
    }
}