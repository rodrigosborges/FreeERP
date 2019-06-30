<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder{

    public function run(){
        DB::table('usuario')->insert([
            [
                'nome'  => 'Administrador',
                'email' => "admin@root.com",
                'password' => 'cGFzc3dvcmQxIQ==', /* password1!*/ 
            ],
        ]);
    }
}