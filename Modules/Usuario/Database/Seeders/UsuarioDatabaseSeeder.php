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
                'nome' => 'admin',
            ]);
        }catch(\Exception $e){}
        
        DB::table('usuario')->insert([
            'apelido' => 'admin',
            'avatar' => 'default.png',
            'papel_id' => 1,            
            'email' => 'admin@freeerp.com',
            'papel_id' => Papel::where('nome', '=', 'admin')->firstOrFail()->id,
            'password' => bcrypt('password'),
        ]);

        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
