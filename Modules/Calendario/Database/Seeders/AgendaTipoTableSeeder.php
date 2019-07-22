<?php

namespace Modules\Calendario\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Calendario\Entities\Tipo;

class AgendaTipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::insert([
            ['nome' => 'Pessoal'],
            ['nome' => 'Setorial'],
            ['nome' => 'Empresarial']
        ]);
    }
}
