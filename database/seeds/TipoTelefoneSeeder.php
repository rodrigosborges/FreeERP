<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoTelefoneSeeder extends Seeder{

    public function run(){
        DB::table('tipo_telefone')->insert([
            [
                'nome'          => 'Residencial',
            ],
            [
                'nome'          => 'Celular',
            ],
            [
                'nome'          => 'Comercial',
            ],
        ]);
    }
}
