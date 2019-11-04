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
                        <span class='list-content'>{{ count($data['avaliacoes'])-count($data['avaliacoes_abertas'])-count($data['avaliacoes_atrasadas']) }}</span>
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
                        <span class='list-content'>{{ count($data['processos'])-count($data['processos_abertos'])-count($data['processos_atrasados']) }}</span>
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

            @if ($data['processo_ultimo'][0]->status->id == 3)

                <h1>Resultados Ultimo Processo</h1>

                <div class="info">
                    
                    <div>
                        <p><b>Processo: </b>{{ $data['processo_ultimo'][0]->nome }}</p>
                        <p><b>Data Encerramento: </b>{{ $data['processo_ultimo'][0]->data_fim }}</p>
                        <p><b>Status: </b>{{ $data['processo_ultimo'][0]->status->nome }}</p>
                    </div>
                    <div>
                        <p><b>Avaliações: </b>{{ count($data['processo_ultimo'][0]->avaliacoes) }}</p>
                        <ul class="setores-list">
                            <b>Setores Avaliados: </b>
                            @foreach ($data['processo_ultimo'][0]->avaliacoes as $avaliacao)
                                <li><b>{{ ucwords($avaliacao->nome) }}:</b> {{ $avaliacao->setor->nome }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            
            @else
            
                <div class="info">
                    <div>
                        <p><b>Processo: </b>{{ $data['processo_ultimo'][0]->nome }}</p>
                        <p><b>Status: </b>{{ $data['processo_ultimo'][0]->status->nome }}</p>
                    </div>
                    <div>
                        <p><b>Data Encerramento: </b>{{ $data['processo_ultimo'][0]->data_fim }}</p>
                        <p><b>Avaliações: </b>{{ count($data['processo_ultimo'][0]->avaliacoes) }}</p>
                    </div>
                </div>

                <br><hr><br>

                <h5>Avaliações Pendentes</h5>
                <table class="table table-stripped table-sm">

                    <thead>
                        <tr>
                            <th>Avaliação</th>
                            <th>Setor</th>
                            <th>Responsável</th>
                            <th>Prazo Final</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data['processo_ultimo'][0]->avaliacoes as $avaliacao)
                            @if ($avaliacao->status->id != 3)
                                <tr>
                                    <td>{{ $avaliacao->nome }}</td>
                                    <td>{{ $avaliacao->setor->nome }}</td>
                                    <td>{{ $avaliacao->responsavel->nome }}</td>
                                    <td>{{ $avaliacao->data_fim }}</td>
                                    <td>{{ $avaliacao->status->nome }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>

                </table>

                <br><hr><br>

                <h5>Avaliações Encerradas</h5>
                <table class="table table-stripped table-sm">

                    <thead>
                        <tr>
                            <th>Avaliação</th>
                            <th>Setor</th>
                            <th>Responsável</th>
                            <th>Prazo Final</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data['processo_ultimo'][0]->avaliacoes as $avaliacao)
                            @if ($avaliacao->status->id == 3)
                                <tr>
                                    <td>{{ $avaliacao->nome }}</td>
                                    <td>{{ $avaliacao->setor->nome }}</td>
                                    <td>{{ $avaliacao->responsavel->nome }}</td>
                                    <td>{{ $avaliacao->data_fim }}</td>
                                    <td>{{ $avaliacao->status->nome }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>

                </table>
            
            @endif

        </div>

    </div>

</div>

@endsection