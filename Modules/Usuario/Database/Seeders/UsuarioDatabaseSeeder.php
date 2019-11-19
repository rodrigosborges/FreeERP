<?php

namespace Modules\Usuario\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;
use Modules\Usuario\Entities\Papel;

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
        
        DB::table('modulo')->insert([
            'nome' => 'Usuario',
            'icone' => 'person'
        ]);

        DB::table('usuario')->insert([
            'apelido' => 'admin',
            'avatar' => 'default.png',
            // 'papel_id' => 1,            
            'email' => 'admin@freeerp.com',
            'password' => bcrypt('password'),
        ]);

        DB::table('papel_has_modulo')->insert([
            'papel_id' => 1,
            'modulo_id' => 1,
        ]);

        DB::table('usuario_has_modulo')->insert([
            'papel_id' => 1,
            'modulo_id' => 1,
            'usuario_id' => 1,
        ]);

        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
