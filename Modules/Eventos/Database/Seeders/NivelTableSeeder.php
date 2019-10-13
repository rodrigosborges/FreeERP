<?php

namespace Modules\Eventos\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NivelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nivel')->insert([
            ['descricao' => 'participante'],
            ['descricao' => 'organizador'],
            ['descricao' => 'administrador'],
        ]);
    }
}
