<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventoSeeder extends Seeder
{
    public function run()
    {
        DB::table('evento')->insert(
            [
                [
                    "nome" => "III Fórum Mackenzie de Liberdade Econômica",
                    "local" => "Mackenzie - Campus Higienópolis",
                    "dataInicio" => "2019-11-26",
                    "dataFim" => "2019-11-29",
                    "descricao" => "No intuito de promover a difusão das ideias, das experiências e das pesquisas em liberdade econômica, o Centro Mackenzie de Liberdade Econômica promove a terceira edição do evento.<br/>Este ano teremos três principais temáticas em destaque:<br/>- Empreendedorismo, inovação e gestão<br/>- Política e economia de livre mercado<br/>- Filosofia, religião e liberdade econômica<br/>O III Fórum de Liberdade Econômica acontecerá nos dias 26 a 29 de Novembro e terá a presença de palestrantes nacionais e internacionais.",
                    "imagem" => "forum.png",
                    "empresa" => "Mackenzie",
                    "email" => "contato@mackenzie.com.br",
                    "telefone" => "(11)3244-6597",
                    "cidade_id"	=> "5270"
                ],
                [
                    "nome" => "IV SEMANA DE ARQUITETURA E URBANISMO - UNIFACS/FSA",
                    "local" => "UNIFACS Campus Santa Monica",
                    "dataInicio" => "2019-12-02",
                    "dataFim" => "2019-12-06",
                    "descricao" => "Esse projeto de excelência acadêmica do curso de Arquitetura e Urbanismo da UNIFACS/Feira de Santana, onde tem como objetivo a discussão da cidade em seu âmbito geral junto com a importância da Arquitetura e como as duas podem juntas fazer melhorias.  Esse projeto tem parceria com profissionais e órgãos da administração municipal.",
                    "imagem" => "diretorio.jpg",
                    "empresa" => "DARQ UNIFACS-FSA",
                    "email" => "contato@darq.edu.br",
                    "telefone" => "(25)98127-0182",
                    "cidade_id"	=> "411"
                ],
                [
                    "nome" => "1º Colóquio de Ciência e Tecnologia",
                    "local" => "Auditorio Andrea Borelli",
                    "dataInicio" => "2019-12-17",
                    "dataFim" => "2019-12-17",
                    "descricao" => "Diante da importância do tema para as nossas escolas, o colóquio tem como objetivo convidar educadores, professores e gestores para uma reflexão a cerca da Sociedade Digital e os desafios da Base Nacional Comum Curricular. Referência em currículo e avaliação no Brasil, a Professora Dra. Maria Inês Fini ressaltará as mudanças na sociedade que irrefutavelmente nos conduz para um novo cenário na educação.",
                    "imagem" => "coloquio.jpg",
                    "empresa" => "BNCC",
                    "email" => "contatobncc.org.br",
                    "telefone" => "(31)4564-2309",
                    "cidade_id"	=> "4925"
                ]
            ]
        );
    }
}