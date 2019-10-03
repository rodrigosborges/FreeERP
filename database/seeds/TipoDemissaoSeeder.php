<?php

use Illuminate\Database\Seeder;

class TipoDemissaoSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        DB::table('tipo_demissao')->insert([
            [
                'tipo' => 'Pedido de demissão no contrato de experiência',
            ],
            [
                'tipo' => 'Demissão no contrato de experiência',
            ],
            [
                'tipo' => 'Término de contrato de experiência',
            ],
            [
                'tipo' => 'Demissão por justa causa(empresa)',
            ],
            [
                'tipo' => 'Demissão sem justa causa',
            ],
            [
                'tipo' => 'Pedido de demissão sem justa causa',
            ],
            [
                'tipo' => 'Demissão por acordo',
            ],
            [
                'tipo' => 'Demissão por aposentadoria',
            ],
            [
                'tipo' => 'Demissão por morte',
            ]
        ]);
    }
}
