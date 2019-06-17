<?php

namespace Modules\ContaAReceber\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ContaAReceberDatabaseSeeder extends Seeder
{
  public function run(){
      DB::table('categoria_receber')->insert([
          [
            'nome' => 'Energia Elétrica',
            'ativo' => 1
          ],
          [
            'nome' => 'Internet',
            'ativo' => 1
          ],
          [
            'nome' => 'Telefone',
            'ativo' => 1
          ],
          [
            'nome' => 'TV por assinatura',
            'ativo' => 1
          ],
          [
            'nome' => 'Água',
            'ativo' => 1
          ],
          [
            'nome' => 'Impostos',
            'ativo' => 1
          ]
      ]);
      DB::table('forma_pagamento_receber')->insert([
        [
          'nome' => 'Dinheiro',
          'taxa' => 0,
          'prazo_recebimento' => 0,
          'ativo' => 1
        ]
      ]);
  }
}
