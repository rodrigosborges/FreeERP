<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PapelSeeder extends Seeder{

    public function run(){
        DB::table('papel')->insert([
            [
                'nome'          => 'Visitante',
                'descricao'     => "Possui a permissão de visualização apenas.",
                'usuario_id'    =>'1',
            ],
            [
                'nome'          => 'Operador',
                'descricao'     => "Possui as permissões de visualização e inserção.",
                'usuario_id'    =>'1',
            ],
            [
                'nome'          => 'Gerente',
                'descricao'     => "possui as permissões de visualização, inserção e inativação.",
                'usuario_id'    =>'1',
            ],
            [
                'nome'          => 'Administrador',
                'descricao'     => 'Possui todas as permissões',
                'usuario_id'    =>'1',
            ],
         
        ]);
    }

}