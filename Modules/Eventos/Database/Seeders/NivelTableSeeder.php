<?php

namespace Modules\Eventos\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
            'id' => 0,
            'descricao' => 'participante',
        ],
        [
            'id' => 1,
            'descricao' => 'organizador',
        ],
        [
            'id' => 2,
            'descricao' => 'administrador',
        ]);
    }
}
