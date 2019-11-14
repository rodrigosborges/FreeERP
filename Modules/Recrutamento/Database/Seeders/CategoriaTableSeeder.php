<?php

namespace Modules\Recrutamento\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria')->insert([
            'nome' => 'Administrativo ',
        ]);
        DB::table('categoria')->insert([
            'nome' => 'Financeiro',
        ]);
        DB::table('categoria')->insert([
            'nome' => 'Marketing',
        ]);
        DB::table('categoria')->insert([
            'nome' => 'Vendas',
        ]);
        DB::table('categoria')->insert([
            'nome' => 'Gestão Empresarial',
        ]);
        DB::table('categoria')->insert([
            'nome' => 'Suprimento',
        ]);
        Model::unguard();
    }
}
