<?php

namespace Modules\EstoqueMadeireira\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EstoqueMadeireiraDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
           CategoriaSeedTableSeeder::class,
           FornecedorSeedTableSeeder::class,
           UnidadeMedidaSeedTableSeeder::class,
          TipoUnidadeSeedTableSeeder::class,
          tipoDocumentoSeedTableSeeder::class,
           ProdutoSeedTableSeeder::class,
        ]);
    }
}