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
        
        DB::table('usuario')->insert([
            'apelido' => 'admin',
            'avatar' => 'default.png',
            'papel_id' => 1,            
            'email' => 'admin@erpedu.com',
            'password' => bcrypt('password'),
            'reset_password_token' =>'',
        ]);

        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
