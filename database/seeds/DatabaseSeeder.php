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
            EstadoCivilSeeder::class,
            EstadoSeeder::class,
            CidadeSeeder::class,
            TipoDocumentoSeeder::class,
            TipoTelefoneSeeder::class,
            Modules\Cliente\Database\Seeders\ClienteDatabaseSeeder::class,
            Modules\Estoque\Database\Seeders\EstoqueDatabaseSeeder::class,
            Modules\Funcionario\Database\Seeders\FuncionarioDatabaseSeeder::class,
            Modules\Usuario\Database\Seeders\UsuarioDatabaseSeeder::class,
        ]);
    }
}
