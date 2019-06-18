<?php

use Illuminate\Database\Seeder;

class CategoriaReceberSeeder extends Seeder
{
    public function run()
    {
        DB::table('categoria_receber')->insert([
          [
            'nome' => 'Clientes'
           
          ],
          [
            'nome' => 'Funcionário'
          ]
        ]);
    }
}
