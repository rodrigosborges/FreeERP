<?php

use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    public function run(){
        DB::table('estado')->insert([
            [
                "id"    => "1",
                "nome"  => "Acre",
                "uf"    => "AC"
            ],
            [
                "id"    => "2",
                "nome"  => "Alagoas",
                "uf"    => "AL"
            ],
            [
                "id"    => "3",
                "nome"  => "Amazonas",
                "uf"    => "AM"
            ],
            [
                "id"    => "4",
                "nome"  => "Amapá",
                "uf"    => "AP"
            ],
            [
                "id"    => "5",
                "nome"  => "Bahia",
                "uf"    => "BA"
            ],
            [
                "id"    => "6",
                "nome"  => "Ceará",
                "uf"    => "CE"
            ],
            [
                "id"    => "7",
                "nome"  => "Distrito Federal",
                "uf"    => "DF"
            ],
            [
                "id"    => "8",
                "nome"  => "Espírito Santo",
                "uf"    => "ES"
            ],
            [
                "id"    => "9",
                "nome"  => "Goiás",
                "uf"    => "GO"
            ],
            [
                "id"    => "10",
                "nome"  => "Maranhão",
                "uf"    => "MA"
            ],
            [
                "id"    => "11",
                "nome"  => "Minas Gerais",
                "uf"    => "MG"
            ],
            [
                "id"    => "12",
                "nome"  => "Mato Grosso do Sul",
                "uf"    => "MS"
            ],
            [
                "id"    => "13",
                "nome"  => "Mato Grosso",
                "uf"    => "MT"
            ],
            [
                "id"    => "14",
                "nome"  => "Pará",
                "uf"    => "PA"
            ],
            [
                "id"    => "15",
                "nome"  => "Paraíba",
                "uf"    => "PB"
            ],
            [
                "id"    => "16",
                "nome"  => "Pernambuco",
                "uf"    => "PE"
            ],
            [
                "id"    => "17",
                "nome"  => "Piauí",
                "uf"    => "PI"
            ],
            [
                "id"    => "18",
                "nome"  => "Paraná",
                "uf"    => "PR"
            ],
            [
                "id"    => "19",
                "nome"  => "Rio de Janeiro",
                "uf"    => "RJ"
            ],
            [
                "id"    => "20",
                "nome"  => "Rio Grande do Norte",
                "uf"    => "RN"
            ],
            [
                "id"    => "21",
                "nome"  => "Rondônia",
                "uf"    => "RO"
            ],
            [
                "id"    => "22",
                "nome"  => "Roraima",
                "uf"    => "RR"
            ],
            [
                "id"    => "23",
                "nome"  => "Rio Grande do Sul",
                "uf"    => "RS"
            ],
            [
                "id"    => "24",
                "nome"  => "Santa Catarina",
                "uf"    => "SC"
            ],
            [
                "id"    => "25",
                "nome"  => "Sergipe",
                "uf"    => "SE"
            ],
            [
                "id"    => "26",
                "nome"  => "São Paulo",
                "uf"    => "SP"
            ],
            [
                "id"    => "27",
                "nome"  => "Tocantins",
                "uf"    => "TO"
            ]
        ]);
    }
}
