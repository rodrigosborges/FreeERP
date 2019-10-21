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
                    <p><b>Nome: </b>{{ $avaliador->funcionario->nome }}</p>
                    <p><b>E-mail: </b>{{ $avaliador->funcionario->email->email }}</p>
                    <p><b>Setor: </b>{{ $avaliador->funcionario->setor->nome }}</p>
                </div>

                <div class="gerais">
                    <p><b>Data Inicio Processo: </b>{{ $avaliacao->processo->data_inicio }}</p>
                    <p><b>Data Fim Processo: </b>{{ $avaliacao->processo->data_fim }}</p>
                </div>

                <div class="gestor">
                    <p><b>Gestor Avaliado: </b>{{ $avaliador->funcionario->setor->gestor->nome }}</p>
                    <p><b>Processo: </b>{{ $avaliacao->processo->nome }}</p>
                    <p><b>Avaliacao: </b>{{ $avaliacao->nome }}</p>
                </div>

            </div>

            <hr>

            <div class="questoes">

                <form action="{{ url('avaliacaodesempenho/avaliacao/respostas') }}" method="POST">
                    {{ csrf_field() }}

                    <input type="hidden" name="avaliacao[avaliacao_id]" value="{{$avaliacao->id}}">
                    <input type="hidden" name="avaliacao[avaliador_id]" value="{{$avaliador->id}}">
                    <input type="hidden" name="avaliacao[funcionario_id]" value="{{$avaliador->funcionario->id}}">
                    <input type="hidden" name="avaliacao[tipo_avaliacao_id]" value="{{$avaliacao->tipo->id}}">

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
                                    a) <input required type="radio" name='avaliacao[questoes][{{$questao->id}}]' value='1'> {{ $questao->opt1 }}
                                    <br>
                                    b) <input type="radio" name='avaliacao[questoes][{{$questao->id}}]' value='2'> {{ $questao->opt2 }}
                                    <br>
                                    c) <input type="radio" name='avaliacao[questoes][{{$questao->id}}]' value='3'> {{ $questao->opt3 }}
                                    <br>
                                    d) <input type="radio" name='avaliacao[questoes][{{$questao->id}}]' value='4'> {{ $questao->opt4 }}
                                    <br>
                                    e) <input type="radio" name='avaliacao[questoes][{{$questao->id}}]' value='5'> {{ $questao->opt5 }}
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

@section('script')
    <!-- <script src="{{Module::asset('avaliacaodesempenho:js/avaliados/index.js')}}"></script> -->
@endsection