<?php

namespace Modules\Estoque\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TipoUnidadeSeedTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipo_unidade')->insert([
        [
            'nome' => 'teste1',
            'quantidade_itens' => '10',
            'created_at'    => '2019-08-02 02:32:44'
        ],
        [
            'nome' => 'teste2',
            'quantidade_itens' => '13',
            'created_at'    => '2019-08-09 02:32:44'
        ],
        [
            'nome' => 'teste3',
            'quantidade_itens' => '15',
            'created_at'    => '2019-08-07 02:32:44'
        ],
        [
            'nome' => 'teste4',
            'quantidade_itens' => '8',
            'created_at'    => '2019-08-05 02:32:44'
        ],
        [
            'nome' => 'teste5',
            'quantidade_itens' => '20',
            'created_at'    => '2019-08-04 02:32:44'
        ],
        ]);

    }
}
