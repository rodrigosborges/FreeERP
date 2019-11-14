<?php

use Illuminate\Database\Seeder;

class TipoProtocoloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_protocolo')->insert([
            [
                'tipo'          => 'Tipo de protocolo 1',
            ],
            [
                'tipo'          => 'Tipo de protocolo 2',
            ],
            [
                'tipo'          => 'Tipo de protocolo 3',
            ],
            [
                'tipo'          => 'Tipo de protocolo 4',
            ],
            [
                'tipo'          => 'Tipo de protocolo 5',
            ],
        ]);
    }
}
