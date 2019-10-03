<?php

namespace Modules\Estoque\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoriaSeedTableSeeder extends Seeder{
    public function run()
    {
            DB::table('categoria')->insert([
                [
                    'nome'          => 'Teste1',
                    'created_at'    => '2019-07-18 02:32:44'
                ],
                [
                    'nome'          => 'Teste2',
                    'created_at'    => '2019-07-16 02:32:44'
                ],
                [
                    'nome'          => 'Teste3',
                    'created_at'    => '2019-07-14 02:32:44'
                ],
                [
                    'nome'          => 'Teste4',
                    'created_at'    => '2019-07-12 02:32:44'
                ],
                [
                    'nome'          => 'Teste5',
                    'created_at'    => '2019-07-11 02:32:44'
                ],
            ]);
        
    }
}