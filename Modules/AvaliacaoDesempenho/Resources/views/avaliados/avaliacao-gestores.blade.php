@extends('avaliacaodesempenho::avaliados/template')

@section('css')
    <link href="{{Module::asset('avaliacaodesempenho:css/avaliados/avaliacao.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class='prova'>

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
                    <p><b>Setor Avaliado: </b>{{ $setor->nome }}</p>
                    <p><b>Quantidade de Funcionários Avaliados: </b>{{ count($funcionarios) }}</p>
                    <p><b>Processo: </b>{{ $avaliacao->processo->nome }}</p>
                    <p><b>Avaliacao: </b>{{ $avaliacao->nome }}</p>
                </div>

            </div>

            <hr>

            @include('avaliacaodesempenho::avaliados._table', ['funcionarios' => $funcionarios])
            
            <hr>

            <div class="questoes">

                <form action="{{ url('avaliacaodesempenho/avaliacao/respostas') }}" method="POST">
                    {{ csrf_field() }}

                    <input id="funcionarioId" type="hidden" name='funcionario_id'>

                    @foreach($questoes as $key => $questao)

                        <div class="card questao">

                            <div class="card-header">
                                <b>Categoria: {{ $questao->categoria->nome }}</b>
                            </div>

                            <div class="card-body">

                                <b>Enunciado:</b>
                                <p>{{ $questao->enunciado }}</p>
                        
                                <hr>
                        
                                <b>Alternativas:</b>
                                <ul>
                                    <br>
                                    a) <input type="radio" name='avaliacao[gestor_'.$key.']' value='1'> {{ $questao->opt1 }}
                                    <br>
                                    b) <input type="radio" name='avaliacao[gestor_'.$key.']' value='2'> {{ $questao->opt2 }}
                                    <br>
                                    c) <input type="radio" name='avaliacao[gestor_'.$key.']' value='3'> {{ $questao->opt3 }}
                                    <br>
                                    d) <input type="radio" name='avaliacao[gestor_'.$key.']' value='4'> {{ $questao->opt4 }}
                                    <br>
                                    e) <input type="radio" name='avaliacao[gestor_'.$key.']' value='5'> {{ $questao->opt5 }}
                                </ul>

                            </div>

                        </div>

                    @endforeach

                    <div class="row">
                        <button class="btn btn-success col-md-12" type='submit'>Enviar</button>
                    </div>
                
                </form>

            </div>

        </div>

    </div>

@endsection

@section('scripts')
    <script src="{{Module::asset('avaliacaodesempenho:js/avaliados/index.js')}}"></script>
@endsection