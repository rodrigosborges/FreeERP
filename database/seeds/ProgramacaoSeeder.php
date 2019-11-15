<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programacao')->insert(
            [
                [
                    'nome' => 'Sociedade Digital e os Desafios da BNCC',
                    'tipo' => 'Outro',
                    'descricao' => NULL,
                    'data' => '2019-12-17',
                    'horario' => '18:30:00',
                    'duracao' => '02:00:00',
                    'local' => 'Auditório Andrea Borelli',
                    'vagas' => '80',
                    'evento_id' => '3',
                    'palestrante_id' => '1'
                ],
                [
                    'nome' => 'Inovação e Renovação: um olhar sobre o valor criado por novos produtos',
                    'tipo' => 'Palestra',
                    'descricao' => 'Palestra voltada aos estudantes de economia.',
                    'data' => '2019-11-26',
                    'horario' => '09:00:00',
                    'duracao' => '01:30:00',
                    'local' => 'Salão Nobre',
                    'vagas' => '40',
                    'evento_id' => '1',
                    'palestrante_id' => '2'
                ],
                [
                    'nome' => 'Minicurso Teórico 1: Charcutaria: processos, tendências e ferramentas de mercado',
                    'tipo' => 'Minicurso',
                    'descricao' => 'Minicurso voltado para os alunos de gastronomia e demais interessados.',
                    'data' => '2019-11-27',
                    'horario' => '07:30:00',
                    'duracao' => '11:30:00',
                    'local' => 'Sala de aula do DCTA1',
                    'vagas' => '30',
                    'evento_id' => '1',
                    'palestrante_id' => '3'
                ],
            ]
        );
    }
}