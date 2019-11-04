@extends('template')

@section('css')
<link href="{{Module::asset('avaliacaodesempenho:css/dashboard/index.css')}}" rel="stylesheet">
@endsection

@section('content')

<div class='container'>

    <div class='row dash-cards'>

        <div class='col-md-4'>

            <div class='card'>

                <div class='card-header bg-primary'>
                    <span class='text-white'>INFORMAÇÕES GERAIS</span>
                </div>

                <ul class='list-group list-group-flush'>
                    <li class='list-group-item'>
                        <span class='list-label'>Processos Cadastrados</span>
                        <span class='list-content'>{{ count($data['processos']) }}</span>
                    </li>
                    <li class='list-group-item'>
                        <span class='list-label'>Avaliações Cadastradas</span>
                        <span class='list-content'>{{ count($data['avaliacoes']) }}</span>
                    </li>
                    <li class='list-group-item'>
                        <span class='list-label'>Funcionários Cadastrados</span>
                        <span class='list-content'>{{ count($data['funcionarios']) }}</span>
                    </li>
                </ul>

                <div class='card-footer'></div>
            </div>

        </div>

        <div class='col-md-4'>

            <div class='card'>
                <div class='card-header bg-primary'>
                    <span class='text-white'>RESUMO AVALIAÇÕES</span>
                </div>

                <ul class='list-group list-group-flush'>                
                    <li class='list-group-item'>
                        <span class='list-label'>Avaliações Abertas</span>
                        <span class='list-content'>{{ count($data['avaliacoes_abertas']) }}</span>
                    </li>
                    <li class='list-group-item'>
                        <span class='list-label'>Avaliações Encerradas</span>
                        <span class='list-content'>{{ count($data['avaliacoes'])-count($data['avaliacoes_abertas']) }}</span>
                    </li>
                    <li class='list-group-item'>
                        <span class='list-label'>Avaliações Atrasadas</span>
                        <span class='list-content'>{{ count($data['avaliacoes_atrasadas']) }}</span>
                    </li>
                </ul>

                <div class='card-footer'></div>
            </div>

        </div>

        <div class='col-md-4'>

            <div class='card'>
                <div class='card-header bg-primary'>
                    <span class='text-white'>RESUMO PROCESSOS</span>
                </div>
                
                <ul class='list-group list-group-flush'>                
                    <li class='list-group-item'>
                        <span class='list-label'>Processos Abertos</span>
                        <span class='list-content'>{{ count($data['processos_abertos']) }}</span>
                    </li>
                    <li class='list-group-item'>
                        <span class='list-label'>Processos Encerrados</span>
                        <span class='list-content'>{{ count($data['processos'])-count($data['processos_abertos']) }}</span>
                    </li>
                    <li class='list-group-item'>
                        <span class='list-label'>Processos Atrasados</span>
                        <span class='list-content'>{{ count($data['processos_atrasados']) }}</span>
                    </li>
                </ul>

                <div class='card-footer'></div>
            </div>

        </div>

    </div>

    <div class="row dash-cards">

        <div class="col-md-12">

            <h1>Resultados Ultimo Processo</h1>

            <div class="info">

                <p><b>Processo: </b>{{ $data['processo_ultimo'][0]->nome }}</p>
                <p><b>Data Encerramento: </b>{{ $data['processo_ultimo'][0]->data_fim }}</p>
                <p><b>Avaliações: </b>{{ count($data['processo_ultimo'][0]->avaliacoes) }}</p>

                <ul class="setores-list">
                    <b>Setores Avaliados: </b>
                    @foreach ($data['processo_ultimo'][0]->avaliacoes as $avaliacao)
                        <li>{{ $avaliacao->setor->nome }}</li>
                    @endforeach
                </ul>

            </div>

        </div>

    </div>

</div>

@endsection