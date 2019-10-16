<?php

namespace Modules\Ordemservico\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Ordemservico\Database\Seeders\{StatusTableSeeder,EstadoTableSeeder,CidadeTableSeeder};

class OrdemServicoDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StatusTableSeeder::class);
        $this->call(EstadoTableSeeder::class);
        $this->call(CidadeTableSeeder::class);
    }
}
