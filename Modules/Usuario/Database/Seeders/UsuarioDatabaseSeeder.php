<?php

namespace Modules\Usuario\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;
use Modules\Usuario\Entities\{Papel, Modulo, Usuario};

class UsuarioDatabaseSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        try{
            DB::table('papel')->insert([
                'nome' => 'Administrador'
            ]);
        }catch(\Exception $e){}
        
        try{
            DB::table('papel')->insert([
                'nome' => 'Visitante'
            ]);
        }catch(\Exception $e){}

        try{
            DB::table('modulo')->insert([
                'nome' => 'Usuario',
                'icone' => 'definir...'
            ]);
        }catch(\Exception $e){}

        
        DB::table('usuario')->insert([
            'apelido' => 'admin',
            'avatar' => 'default.png',
            //'papel_id' => 1,            
            'email' => 'admin@freeerp.com',
            'password' => bcrypt('password'),
        ]);

        //relação entre o papel Administrador e o modulo Usuario
        try{
            DB::table('papel_has_modulo')->insert([
                'papel_id' => Papel::where('nome', '=', 'Administrador')->first()->getKey(), 
                'modulo_id' => Modulo::where('nome', '=', 'Usuario')->first()->getKey(),
            ]);
        }catch(\Exception $e){}


        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
