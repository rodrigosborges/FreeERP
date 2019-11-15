<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PalestranteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('palestrante')->insert(
            [
                [
                    'nome' => 'Maria Inês Fini',
                    'bio' => 'Doutora em Ciências - Educação, Pedagoga, Professora e Pesquisadora em Psicologi a da Educação, Psicologia do Desenvolvimento, Social e do Trabalho, Especialista em Currículo e Avaliação, com experiência em Gestão Educacional na Educação Básica e Superior. Fundadora da Faculdade de Educação da UNICAMP, onde atuou de 1972 a 1996, exercendo cargos como docente, pesquisadora e funções administrativas e de representação.',
                    'foto' => 'maria.jpg'
                ],
                [
                    'nome' => 'Rodrigo Alves Coelho',
                    'bio' => 'I´m a resourceful senior leader with over 20 years of diverse working experience  across Brazil, Latin America, Europe, Eurasia (including Russia) and China. My experience and versatility are combined with an extremely robust educational background including a top ranked Global Executive MBA, 4 Postgraduate degrees and a Food Engineering degree with honors.',
                    'foto' => 'rodrigo.jpg'
                ],
                [
                    'nome' => 'Marielle Maria de Oliveira Paula',
                    'bio' => 'Possui graduação em Ciência e Tecnologia de Alimentos (2015) pelo Instituto Fede ral de Edução, Ciência e Tecnologia- Campus Rio Pomba (IFSEMG ), mestrado em Ciência dos Alimentos (2017) pela Universidade Federal de Lavras. Atualmente é doutoranda em Ciência dos Alimentos também pela Universidade Federal de Lavras (UFLA) (2018). Possui experiência na área de Ciência e Tecnologia de Alimentos, com ênfase em Tecnologia de Produtos de Origem Animal, atuando principalmente nos seguintes temas: processamento de carnes e derivados, qualidade da carne, ciência e tecnologia de carnes e tecnologia do leite e produtos lácteos.',
                    'foto' => 'marielle.jpg'
                ],
            ]
        );
    }
}
