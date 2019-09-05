<?php

namespace Modules\Usuario\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class UsuarioDatabaseSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('papel')->insert([
            'nome' => 'admin',
        ]);
        
        DB::table('usuario')->insert([
            'apelido' => 'admin',
            'avatar' => 'default.png',            
            'email' => 'admin@freeerp.com',
            'password' => bcrypt('password'),
        ]);

        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
