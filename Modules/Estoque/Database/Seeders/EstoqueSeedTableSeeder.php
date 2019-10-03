<?php

namespace Modules\Estoque\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EstoqueSeedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estoque')->insert([
            [
                'quantidade' => 13,
                'tipo_unidade_id' => 1,
                'quantidade_notificacao' => 5,
                'created_at'    => '2019-07-29 02:32:44'
            ],
            [
                'quantidade' => 20,
                'tipo_unidade_id' => 2,
                'quantidade_notificacao' => 3,
                'created_at'    => '2019-07-23 02:32:44'
            ],
            [
                'quantidade' => 12,
                'tipo_unidade_id' => 3,
                'quantidade_notificacao' => 33,
                'created_at'    => '2019-07-25 02:32:44'
            ],
            [
                'quantidade' => 22,
                'tipo_unidade_id' => 4,
                'quantidade_notificacao' => 14,
                'created_at'    => '2019-07-26 02:32:44'
            ],
            [
                'quantidade' => 16,
                'tipo_unidade_id' => 5,
                'quantidade_notificacao' => 11,
                'created_at'    => '2019-07-21 02:32:44'
            ],
        ]);

    }
}
