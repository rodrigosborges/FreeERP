<?php
namespace Modules\EstoqueMadeireira\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UnidadeMedidaSeedTableSeeder extends Seeder {
    public function run(){
      DB::table('unidade_medidas')->insert([
      [
        'nome' => 'Sem Medida',
      
      ],
      [
        'nome' => 'M²',
        
        ],
      [
        'nome' => 'M³',
        
      ],
      [
        'nome' => 'Cm'
      ],
      [
        'nome' => 'Mm'
      ]
     
    ]);
  }
}
