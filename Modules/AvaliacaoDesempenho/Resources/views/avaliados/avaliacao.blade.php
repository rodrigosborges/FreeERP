@extends('avaliacaodesempenho::avaliados/template')

@section('css')
    <link href="{{Module::asset('avaliacaodesempenho:css/avaliados/avaliacao.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class='prova'>

        <pre>
            {{ $avaliacao }}

            {{ $funcionario }}
        </pre>

        <div class="header">

            <p class='title'>INFORMAÇÕES DA AVALIAÇÃO</p>

            <hr>

            <div class="informacoes">

                <div class="funcionario">
                    <p><b>Nome: </b>{{ $funcionario->nome }}</p>
                    <p><b>E-mail: </b>{{ $funcionario->email->email }}</p>
                    <p><b>Setor: </b>{{ $funcionario->setor->nome }}</p>
                </div>

                <div class="gerais">
                    <p><b>Data Inicio Processo: </b>{{ $avaliacao->processo->data_inicio }}</p>
                    <p><b>Data Fim Processo: </b>{{ $avaliacao->processo->data_fim }}</p>
                </div>

                <div class="gestor">
                    <p><b>Gestor Avaliado: </b>{{ $funcionario->setor->gestor->nome }}</p>
                    <p><b>Processo: </b>{{ $avaliacao->processo->nome }}</p>
                    <p><b>Avaliacao: </b>{{ $avaliacao->nome }}</p>
                </div>

            </div>

            <div class="questoes">

                @foreach($questoes as $questao)

                @endforeach

            </div>

        </div>

    </div>

@endsection

@section('script')
    <!-- <script src="{{Module::asset('avaliacaodesempenho:js/avaliados/index.js')}}"></script> -->
@endsection