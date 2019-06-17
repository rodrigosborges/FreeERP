<?php

use Illuminate\Database\Seeder;

class CategoriaReceberSeeder extends Seeder
{
    public function run()
    {
        DB::table('categoria_receber')->insert([
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
