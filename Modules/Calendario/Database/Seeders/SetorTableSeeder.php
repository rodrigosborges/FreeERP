<?php

namespace Modules\Calendario\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Calendario\Entities\Setor;

class SetorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setor::insert([
            ['sigla' => 'CTI', 'nome' => 'Coordenadoria de Tecnologia da Informação'],
            ['sigla' => 'DRG', 'nome' => 'Diretoria Geral']
        ]);
    }
}
