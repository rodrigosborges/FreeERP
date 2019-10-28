<?php

use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    public function run(){
        DB::table('estado')->insert([
            [
                "id"    => "1",
                "nomeEstado"  => "Acre",
                "uf"    => "AC"
            ],
            [
                "id"    => "2",
                "nomeEstado"  => "Alagoas",
                "uf"    => "AL"
            ],
            [
                "id"    => "3",
                "nomeEstado"  => "Amazonas",
                "uf"    => "AM"
            ],
            [
                "id"    => "4",
                "nomeEstado"  => "Amapá",
                "uf"    => "AP"
            ],
            [
                "id"    => "5",
                "nomeEstado"  => "Bahia",
                "uf"    => "BA"
            ],
            [
                "id"    => "6",
                "nomeEstado"  => "Ceará",
                "uf"    => "CE"
            ],
            [
                "id"    => "7",
                "nomeEstado"  => "Distrito Federal",
                "uf"    => "DF"
            ],
            [
                "id"    => "8",
                "nomeEstado"  => "Espírito Santo",
                "uf"    => "ES"
            ],
            [
                "id"    => "9",
                "nomeEstado"  => "Goiás",
                "uf"    => "GO"
            ],
            [
                "id"    => "10",
                "nomeEstado"  => "Maranhão",
                "uf"    => "MA"
            ],
            [
                "id"    => "11",
                "nomeEstado"  => "Minas Gerais",
                "uf"    => "MG"
            ],
            [
                "id"    => "12",
                "nomeEstado"  => "Mato Grosso do Sul",
                "uf"    => "MS"
            ],
            [
                "id"    => "13",
                "nomeEstado"  => "Mato Grosso",
                "uf"    => "MT"
            ],
            [
                "id"    => "14",
                "nomeEstado"  => "Pará",
                "uf"    => "PA"
            ],
            [
                "id"    => "15",
                "nomeEstado"  => "Paraíba",
                "uf"    => "PB"
            ],
            [
                "id"    => "16",
                "nomeEstado"  => "Pernambuco",
                "uf"    => "PE"
            ],
            [
                "id"    => "17",
                "nomeEstado"  => "Piauí",
                "uf"    => "PI"
            ],
            [
                "id"    => "18",
                "nomeEstado"  => "Paraná",
                "uf"    => "PR"
            ],
            [
                "id"    => "19",
                "nomeEstado"  => "Rio de Janeiro",
                "uf"    => "RJ"
            ],
            [
                "id"    => "20",
                "nomeEstado"  => "Rio Grande do Norte",
                "uf"    => "RN"
            ],
            [
                "id"    => "21",
                "nomeEstado"  => "Rondônia",
                "uf"    => "RO"
            ],
            [
                "id"    => "22",
                "nomeEstado"  => "Roraima",
                "uf"    => "RR"
            ],
            [
                "id"    => "23",
                "nomeEstado"  => "Rio Grande do Sul",
                "uf"    => "RS"
            ],
            [
                "id"    => "24",
                "nomeEstado"  => "Santa Catarina",
                "uf"    => "SC"
            ],
            [
                "id"    => "25",
                "nomeEstado"  => "Sergipe",
                "uf"    => "SE"
            ],
            [
                "id"    => "26",
                "nomeEstado"  => "São Paulo",
                "uf"    => "SP"
            ],
            [
                "id"    => "27",
                "nomeEstado"  => "Tocantins",
                "uf"    => "TO"
            ]
        ]);
    }
}
