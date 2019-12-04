<?php

namespace Modules\Cliente\Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_cliente')->insert([
            [
                'nome'      =>'Pessoa Fisica',
            ],
            [
                'nome'      =>'Pessoa Juridica', 
            ]

            
        ]);
    }
}
