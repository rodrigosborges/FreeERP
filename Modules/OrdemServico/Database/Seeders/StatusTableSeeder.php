<?php

namespace Modules\OrdemServico\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->delete();

        DB::table('status')->insert([
            ['titulo' => 'Iniciada'],
            ['titulo' => 'Encaminhada para o técnico'],
            ['titulo' => 'Aguandando peças'],
            ['titulo' => 'Marcado como Inutilizável'],
            ['titulo' => 'Pronta / Aguardando retirada'],
            ['titulo' => 'Pronta / Entrega a Domicilio'],
            ['titulo' => 'Cancelada'],
            ['titulo' => 'Serviço executado'],
        ]);
        Model::unguard();
    }
}
