<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EstadoSeeder::class,
            CidadeSeeder::class,
            EstadoCivilSeeder::class,
            TipoTelefoneSeeder::class,
            TipoDocumentoSeeder::class,
            ParentescoSeeder::class,
        ]);
    }
}
