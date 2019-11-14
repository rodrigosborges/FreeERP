<?php

namespace Modules\Recrutamento\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RecrutamentoDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call([
            CategoriaTableSeeder::class,
            CargoTableSeeder::class,
            EtapaTableSeeder::class
        ]);
        
    }
}
