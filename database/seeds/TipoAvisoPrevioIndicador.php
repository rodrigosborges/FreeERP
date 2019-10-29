<?php

use Illuminate\Database\Seeder;

class TipoAvisoPrevioIndicador extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aviso_previo_indicador_cumprimento')->insert([
            ['tipo_cumprimento' => 'Cumprimento total'],
            ['tipo_cumprimento' => 'Cumprimento parcial em razão de obtenção de novo emprego pelo empregado'],
            ['tipo_cumprimento' => 'Cumprimento parcial por iniciativa do empregador'],
            ['tipo_cumprimento' => 'Outras hipóteses de cumprimento parcial do aviso prévio'],
            ['tipo_cumprimento' => 'Aviso prévio indenizado ou não exigível']
        ]);
    }
}
