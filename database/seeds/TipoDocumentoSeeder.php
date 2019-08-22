<?php

use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipo_documento')->insert([
            [
                'nome'          => 'CPF',
            ],
            [
                'nome'          => 'RG',
            ],
            [
                'nome'          => 'CNH',
            ],
            [
                'nome'          => 'Carteira de trabalho',
            ],
            [
                'nome'          => 'Título de eleitor',
            ],
            [
                'nome'          => 'CNPJ',
            ]
        ]);
    }
}
