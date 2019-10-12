<?php

namespace Modules\Calendario\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CalendarioDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CorTableSeeder::class);
        $this->call(SetorTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(FuncionarioTableSeeder::class);
    }
}
