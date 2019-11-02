<?php

namespace Modules\Calendario\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Calendario\Entities\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            ['email' => 'hscuba@gmail.com', 'password' => '$2y$12$KG.Tx8lQix0VAQVxv6uB4uZYEA32qILp8DCvElz4cKc72ZtkMK10O'],
            ['email' => 'thyago@gmail.com', 'password' => '$2y$12$KG.Tx8lQix0VAQVxv6uB4uZYEA32qILp8DCvElz4cKc72ZtkMK10O']
        ]);
    }
}
