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
            CategoriaPagarSeeder::class,
            CategoriaReceberSeeder::class,
            TipoClienteSeeder::class,
            TipoDocumentoSeeder::class,
            FormaPagamentoReceberSeeder::class,
            // UsuarioSeeder::class,
            // PapelSeeder::class,
            ParentescoSeeder::class,
        ]);
    }
}
