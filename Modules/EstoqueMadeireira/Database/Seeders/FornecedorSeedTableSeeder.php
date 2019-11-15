<?php
namespace Modules\EstoqueMadeireira\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FornecedorSeedTableSeeder extends Seeder {
    public function run(){
      DB::table('fornecedor')->insert([
      [
      'nome' => 'FornecedorJoão',
      'endereco' => 'EndereçoTeste1',
      'cnpj' => '24.761.595/0001-66',
      'telefone' => '(11)1111-11111',
      'email' => 'teste@teste',
      ],
      [
      'nome' => 'FornecedorZé',
      'endereco' => 'EndereçoTeste2',
      'cnpj' => '11.241.516/0001-44',
      'telefone' => '(22)2222-22222',
      'email' => 'teste@teste',
      ],
      [
      'nome' => 'FornecedorJoca',
      'endereco' => 'EndereçoTeste3',
      'cnpj' => '10.359.154/0001-28',
      'telefone' => '(33)3333-33333',
      'email' => 'teste@teste',
      ],
      [
      'nome' => 'FornecedorGilson',
      'endereco' => 'EndereçoTeste4',
      'cnpj' => '45.598.339/0001-70',
      'telefone' => '(44)4444-44444',
      'email' => 'teste@teste',
      ],
      [
      'nome' => 'FornecedorBreno',
      'endereco' => 'EndereçoTeste5',
      'cnpj' => '79.912.236/0001-54',
      'telefone' => '(55)5555-55555',
      'email' => 'teste@teste', 
      ],
    ]);
  }
}
