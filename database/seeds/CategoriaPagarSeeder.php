<?php

use Illuminate\Database\Seeder;

class CategoriaPagarSeeder extends Seeder{
    public function run()
    {
        DB::table('categoria_pagar')->insert([
          [
            'nome' => 'Energia Elétrica'
          ],
          [
            'nome' => 'Internet'
          ],
          [
            'nome' => 'Telefone'
          ],
          [
            'nome' => 'TV por assinatura'
          ],
          [
            'nome' => 'Água'
          ],
          [
            'nome' => 'Impostos'
          ]
        ]);
    }
}
