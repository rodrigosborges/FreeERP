<?php

namespace Modules\Calendario\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Calendario\Entities\Cor;

class CorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cor::insert([
            ['nome' => 'Salmon', 'codigo' => 'FA8072'],
            ['nome' => 'Crimson', 'codigo' => 'DC143C'],
            ['nome' => 'Coral', 'codigo' => 'FF7F50'],
            ['nome' => 'Khaki', 'codigo' => 'F0E68C'],
            ['nome' => 'Yellow Green', 'codigo' => '9ACD32'],
            ['nome' => 'Olive', 'codigo' => '808000'],
            ['nome' => 'Medium Aquamarine', 'codigo' => '66CDAA'],
            ['nome' => 'Dark Cyan', 'codigo' => '008B8B'],
            ['nome' => 'Deep Sky Blue', 'codigo' => '00BFFF'],
            ['nome' => 'Medium Slate Blue', 'codigo' => '7B68EE'],
            ['nome' => 'Light Pink', 'codigo' => 'FFB6C1'],
            ['nome' => 'Peru', 'codigo' => 'CD853F'],
        ]);
    }
}
