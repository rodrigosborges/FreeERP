<?php

namespace Modules\Calendario\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Calendario\Entities\Cor;

class CorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cor::insert([
            ['nome' => 'Branco', 'codigo' => 'FFFFFF'],
            ['nome' => 'Preto', 'codigo' => '000000'],
        ]);
    }
}