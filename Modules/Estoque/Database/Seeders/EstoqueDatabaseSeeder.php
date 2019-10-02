<?php

namespace Modules\Estoque\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EstoqueDatabaseSeeder extends Seeder
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
            ProdutoSeedTableSeeder::class,
        ]);
    }
}
