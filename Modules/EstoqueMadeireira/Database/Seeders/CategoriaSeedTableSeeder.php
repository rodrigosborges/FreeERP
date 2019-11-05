<?php
namespace Modules\EstoqueMadeireira\Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoriaSeedTableSeeder extends Seeder{
    public function run() {
      DB::table('categoria')->insert([
      [
        'nome' => 'CategoriaTeste1'
        //'created_at' => ''
      ],
      [  'nome' => 'CategoriaTeste2'
        //'created_at' => ''
      ],
      [  'nome' => 'CategoriaTeste3'
        //'created_at' => ''
      ],
      [  'nome' => 'CategoriaTeste4'
        //'created_at' => ''
      ],
      [  'nome' => 'CategoriaTeste5'
        //'created_at' => ''
      ],
    
  ]);
}
}