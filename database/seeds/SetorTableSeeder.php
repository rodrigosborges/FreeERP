<?php

use Illuminate\Database\Seeder;

class SetorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setor')->insert([
            [
                'nome'          => 'Financeiro',
            ],
            [
                'nome'          => 'Marketing',
            ],
            [
                'nome'          => 'Recursos Humanos',
            ],
            [
                'nome'          => 'Segurança',
            ],
            [
                'nome'          => 'Manutenção',
            ],
        ]);
    }
}
