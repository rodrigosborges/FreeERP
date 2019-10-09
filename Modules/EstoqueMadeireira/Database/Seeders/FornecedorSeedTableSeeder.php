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
      ],
      [
      'nome' => 'FornecedorZé',
      'endereco' => 'EndereçoTeste2',
      'cnpj' => '11.241.516/0001-44',

      ],
      [
      'nome' => 'FornecedorJoca',
      'endereco' => 'EndereçoTeste3',
      'cnpj' => '10.359.154/0001-28',

      ],
      [
      'nome' => 'FornecedorGilson',
      'endereco' => 'EndereçoTeste4',
      'cnpj' => '45.598.339/0001-70',

      ],
      [
      'nome' => 'FornecedorBreno',
      'endereco' => 'EndereçoTeste5',
      'cnpj' => '79.912.236/0001-54',
      ],
    ]);
  }
}
