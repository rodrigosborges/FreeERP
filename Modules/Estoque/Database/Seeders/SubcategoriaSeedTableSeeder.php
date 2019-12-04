<?php

namespace Modules\Estoque\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubCategoriaSeedTableSeeder extends Seeder{
    public function run()
    {
            DB::table('subcategoria')->insert([
                [
                    'categoria_id'          => '1',
                    'created_at'    => '2019-07-18 02:32:44'
                ],
                [
                    'categoria_id'          => '2',
                    'created_at'    => '2019-07-16 02:32:44'
                ],
                [
                    'categoria_id'          => '3',
                    'created_at'    => '2019-07-14 02:32:44'
                ],
                [
                    'categoria_id'          => '4',
                    'created_at'    => '2019-07-12 02:32:44'
                ],
                [
                    'categoria_id'          => '5',
                    'created_at'    => '2019-07-11 02:32:44'
                ],
            ]);
        
    }
}