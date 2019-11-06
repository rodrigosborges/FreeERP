<?php
namespace Modules\EstoqueMadeireira\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TipoUnidadeSeedTableSeeder extends Seeder {
    public function run(){
      DB::table('tipoUnidade')->insert([
      [
      'nome' => 'Baia',
     
      ],
      [
        'nome' => 'Box',
       
      ]
     
    ]);
  }
}
