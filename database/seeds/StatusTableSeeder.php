<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            [
                'nome'          => 'Criado',
            ],
            [
                'nome'          => 'Aguardando Recebimento',
            ],
            [
                'nome'          => 'Recebido',
            ],
            [
                'nome'          => 'Visualizado',
            ],
            [
                'nome'          => 'Atualizado',
            ],
            [
                'nome'          => 'Finalizado',
            ],
        ]);
    }
}
