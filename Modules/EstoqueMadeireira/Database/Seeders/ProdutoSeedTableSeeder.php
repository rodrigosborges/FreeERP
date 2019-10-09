<?php
namespace Modules\EstoqueMadeireira\Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProdutoSeedTableSeeder extends Seeder {
      public function run(){
        DB::table('produto')->insert([
        [
          'nome' => 'Madeira Teste1',
          'descricao' => 'Produto criado para testes 1',
          'categoria_id' => '1',
          'fornecedor_id' => '1',
          'preco' => '10',
          'codigo' => '123123123'
          //'created_at' => '',
          //'deleted_at' => ''
        ],
        [
          'nome' => 'Madeira Teste2',
          'descricao' => 'Produto criado para testes 2',
          'categoria_id' => '2',
          'fornecedor_id' => '2',
          'preco' => '20',
          'codigo' => '223123123'
          //'created_at' => '',
          //'deleted_at' => ''
        ],
        [
          'nome' => 'Madeira Teste3',
          'descricao' => 'Produto criado para testes 3',
          'categoria_id' => '3',
          'fornecedor_id' => '3',
          'preco' => '30',
          'codigo' => '323123123'
          //'created_at' => '',
          //'deleted_at' => ''
        ],
        [
          'nome' => 'Madeira Teste4',
          'descricao' => 'Produto criado para testes 4',
          'categoria_id' => '4',
          'fornecedor_id' => '4',
          'preco' => '40',
          'codigo' => '423123123'
          //'created_at' => '',
          //'deleted_at' => ''
        ],
        [
        'nome' => 'Madeira Teste5',
        'descricao' => 'Produto criado para testes 5',
        'categoria_id' => '5',
        'fornecedor_id' => '5',
        'preco' => '50',
        'codigo' => '523123123'
        //'created_at' => '',
        //'deleted_at' => ''
       ],
       ]);
        
      }
}