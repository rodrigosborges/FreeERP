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
                ],
                [
                    'nome'          => 'Teste2',
                ],
                [
                    'nome'          => 'Teste3',
                ],
                [
                    'nome'          => 'Teste4',
                ],
                [
                    'nome'          => 'Teste5',
                ],
            ]);
        
    }
}