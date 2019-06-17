<?php
use Illuminate\Database\Seeder;
class FormaPagamentoReceberSeeder extends Seeder
{
    public function run()
    {
        DB::table('forma_pagamento_receber')->insert([
        [
          'nome' => 'Dinheiro',
          'taxa' => 0,
          'prazo_recebimento' => 0
        ]
      ]);
    }
}
