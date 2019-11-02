<?php

namespace Modules\Calendario\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Calendario\Entities\Funcionario;

class FuncionarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Funcionario::insert([
            ['nome' => 'Hugo Salles Cuba', 'setor_id' => 1, 'user_id' => 1],
            ['nome' => 'Thyago Nicollas', 'setor_id' => 1, 'user_id' => 2]
        ]);
    }
}
