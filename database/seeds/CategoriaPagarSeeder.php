<?php

use Illuminate\Database\Seeder;

class CategoriaPagarSeeder extends Seeder{
    public function run()
    {
        DB::table('categoria_pagar')->insert([
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
    }
}
