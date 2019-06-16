<?php

use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    public function run(){
        DB::table('estado')->insert([
            [
                "id"    => "1",
                "nome"  => "Acre"
            ],
            [
                "id"    => "2",
                "nome"  => "Alagoas"
            ],
            [
                "id"    => "3",
                "nome"  => "Amazonas"
            ],
            [
                "id"    => "4",
                "nome"  => "Amapá"
            ],
            [
                "id"    => "5",
                "nome"  => "Bahia"
            ],
            [
                "id"    => "6",
                "nome"  => "Ceará"
            ],
            [
                "id"    => "7",
                "nome"  => "Distrito Federal"
            ],
            [
                "id"    => "8",
                "nome"  => "Espírito Santo"
            ],
            [
                "id"    => "9",
                "nome"  => "Goiás"
            ],
            [
                "id"    => "10",
                "nome"  => "Maranhão"
            ],
            [
                "id"    => "11",
                "nome"  => "Minas Gerais"
            ],
            [
                "id"    => "12",
                "nome"  => "Mato Grosso do Sul"
            ],
            [
                "id"    => "13",
                "nome"  => "Mato Grosso"
            ],
            [
                "id"    => "14",
                "nome"  => "Pará"
            ],
            [
                "id"    => "15",
                "nome"  => "Paraíba"
            ],
            [
                "id"    => "16",
                "nome"  => "Pernambuco"
            ],
            [
                "id"    => "17",
                "nome"  => "Piauí"
            ],
            [
                "id"    => "18",
                "nome"  => "Paraná"
            ],
            [
                "id"    => "19",
                "nome"  => "Rio de Janeiro"
            ],
            [
                "id"    => "20",
                "nome"  => "Rio Grande do Norte"
            ],
            [
                "id"    => "21",
                "nome"  => "Rondônia"
            ],
            [
                "id"    => "22",
                "nome"  => "Roraima"
            ],
            [
                "id"    => "23",
                "nome"  => "Rio Grande do Sul"
            ],
            [
                "id"    => "24",
                "nome"  => "Santa Catarina"
            ],
            [
                "id"    => "25",
                "nome"  => "Sergipe"
            ],
            [
                "id"    => "26",
                "nome"  => "São Paulo"
            ],
            [
                "id"    => "27",
                "nome"  => "Tocantins"
            ]
        ]);
    }
}
