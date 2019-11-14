<?php

namespace Modules\Recrutamento\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CargoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cargo')->insert([
            'nome' => 'Agente Administrativo',
            'categoria_id' => '1',
        ]);
        DB::table('cargo')->insert([
            'nome' => 'Agente Contabil',
            'categoria_id' => '2',
        ]);
        DB::table('cargo')->insert([
            'nome' => 'Atendente Telemarketing',
            'categoria_id' => '3',
        ]);
        DB::table('cargo')->insert([
            'nome' => 'Vendedor',
            'categoria_id' => '4',
        ]);
        DB::table('cargo')->insert([
            'nome' => 'Repositor de Estoque',
            'categoria_id' => '6',
        ]);
        Model::unguard();
        
    }
}
