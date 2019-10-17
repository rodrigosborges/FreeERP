<?php

namespace Modules\Estoque\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UnidadeProdutoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidade_produto')->insert([
            [
                'tipo'       => 'unidadeProdutoTeste1',
                'created_at' => '2019-02-02 02:32:44'
            ],
            [
                'tipo'       => 'unidadeProdutoTeste1',
                'created_at' => '2019-04-02 02:32:44'
            ],
            [
                'tipo'       => 'unidadeProdutoTeste1',
                'created_at' => '2019-06-02 02:32:44'
            ],
            [
                'tipo'       => 'unidadeProdutoTeste1',
                'created_at' => '2019-08-02 02:32:44'
            ],
            [
                'tipo'       => 'unidadeProdutoTeste1',
                'created_at' => '2019-10-02 02:32:44'
            ],
        ]);
    }
}
