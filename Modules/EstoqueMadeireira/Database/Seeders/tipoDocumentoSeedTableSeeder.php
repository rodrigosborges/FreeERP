<?php
namespace Modules\EstoqueMadeireira\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class tipoDocumentoSeedTableSeeder extends Seeder {
    public function run(){
      DB::table('tipo_documentos')->insert([
      [
      'nome' => 'Pessoa Física',
     
      ],
      [
        'nome' => 'Pessoa Jurídica',
       
      ]
     
    ]);
  }
}
