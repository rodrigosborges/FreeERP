<?php

namespace Modules\OrdemServico\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado')->delete();
        DB::table('estado')->insert([
            ['id' => 1, 'nome' => 'Acre', 'abreviacao' => 'AC'],
            ['id' => 2, 'nome' => 'Alagoas', 'abreviacao' => 'AL'],
            ['id' => 3, 'nome' => 'Amapá', 'abreviacao' => 'AP'],
            ['id' => 4, 'nome' => 'Amazonas', 'abreviacao' => 'AM'],
            ['id' => 5, 'nome' => 'Bahia', 'abreviacao' => 'BA'],
            ['id' => 6, 'nome' => 'Ceará', 'abreviacao' => 'CE'],
            ['id' => 7, 'nome' => 'Distrito Federal', 'abreviacao' => 'DF'],
            ['id' => 8, 'nome' => 'Espírito Santo', 'abreviacao' => 'ES'],
            ['id' => 9, 'nome' => 'Goiás', 'abreviacao' => 'GO'],
            ['id' => 10, 'nome' => 'Maranhão', 'abreviacao' => 'MA'],
            ['id' => 11, 'nome' => 'Mato Grosso', 'abreviacao' => 'MT'],
            ['id' => 12, 'nome' => 'Mato Grosso do Sul', 'abreviacao' => 'MS'],
            ['id' => 13, 'nome' => 'Minas Gerais', 'abreviacao' => 'MG'],
            ['id' => 14, 'nome' => 'Pará', 'abreviacao' => 'PA'],
            ['id' => 15, 'nome' => 'Paraíba', 'abreviacao' => 'PB'],
            ['id' => 16, 'nome' => 'Paraná', 'abreviacao' => 'PR'],
            ['id' => 17, 'nome' => 'Pernambuco', 'abreviacao' => 'PE'],
            ['id' => 18, 'nome' => 'Piauí', 'abreviacao' => 'PI'],
            ['id' => 19, 'nome' => 'Rio de Janeiro', 'abreviacao' => 'RJ'],
            ['id' => 20, 'nome' => 'Rio Grande do Norte', 'abreviacao' => 'RN'],
            ['id' => 21, 'nome' => 'Rio Grande do Sul', 'abreviacao' => 'RS'],
            ['id' => 22, 'nome' => 'Rondônia', 'abreviacao' => 'RO'],
            ['id' => 23, 'nome' => 'Roraima', 'abreviacao' => 'RR'],
            ['id' => 24, 'nome' => 'Santa Catarina', 'abreviacao' => 'SC'],
            ['id' => 25, 'nome' => 'São Paulo', 'abreviacao' => 'SP'],
            ['id' => 26, 'nome' => 'Sergipe', 'abreviacao' => 'SE'],
            ['id' => 27, 'nome' => 'Tocantins', 'abreviacao' => 'TO'],
        ]);
        
        Model::unguard();
    
    }
}
