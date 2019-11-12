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
                    <p><b>Avaliacao: </b>{{ $avaliacao->nome }}</p>
                </div>

                <div class="gerais">
                    <p><b>Data Inicio Processo: </b>{{ $avaliacao->processo->data_inicio }}</p>
                    <p><b>Data Fim Processo: </b>{{ $avaliacao->processo->data_fim }}</p>
                </div>

                <div class="gestor">
                    <p><b>Setor Avaliado: </b>{{ $setor->nome }}</p>
                    <p><b>Funcionarios já Avaliados: </b>{{ count($concluidos) }}</p>
                    <p><b>Funcionários a Avaliar: </b>{{ count($funcionarios) }}</p>
                    <p><b>Processo: </b>{{ $avaliacao->processo->nome }}</p>
                </div>

            </div>

            <hr>

            @include('avaliacaodesempenho::avaliados._table', ['funcionarios' => $funcionarios])
            
            <hr>

            <div class="questoes invisible">

                <form action="{{ url('avaliacaodesempenho/avaliacao/respostas') }}" method="POST">
                    {{ csrf_field() }}

                    <input type="hidden" name="avaliacao[avaliacao_id]" value="{{$avaliacao->id}}">
                    <input type="hidden" name="avaliacao[avaliador_id]" value="{{$avaliador->id}}">
                    <input type="hidden" name='avaliacao[funcionario_id]' id="funcionarioId" value="">
                    <input type="hidden" name="avaliacao[tipo_avaliacao_id]" value="{{$avaliacao->tipo->id}}">

                    <div>

                        @foreach($questoes as $key => $questao)
                            
                            <div class="card questao tab">
                                    
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
                                        <b>a)</b> <input required type="radio" name='avaliacao[questoes][{{$questao->id}}]' value='1'> {{ $questao->opt1 }}
                                        <br>
                                        <b>b)</b> <input type="radio" name='avaliacao[questoes][{{$questao->id}}]' value='2'> {{ $questao->opt2 }}
                                        <br>
                                        <b>c)</b> <input type="radio" name='avaliacao[questoes][{{$questao->id}}]' value='3'> {{ $questao->opt3 }}
                                        <br>
                                        <b>d)</b> <input type="radio" name='avaliacao[questoes][{{$questao->id}}]' value='4'> {{ $questao->opt4 }}
                                        <br>
                                        <b>e)</b> <input type="radio" name='avaliacao[questoes][{{$questao->id}}]' value='5'> {{ $questao->opt5 }}
                                    </ul>
    
                                </div>
    
                            </div>
                        
                        @endforeach

                        <div class="control-buttons">
                            <button class='btn btn-sm btn-primary col-md-1' type="button" id="prevBtn" onclick="nextPrev(-1)">Anterior</button>
                            <button id='submit-btn' class="btn btn-sm btn-success col-md-4 invisible" type='submit'>Enviar</button>
                            <button class='btn btn-sm btn-primary col-md-1' type="button" id="nextBtn" onclick="nextPrev(1)">Proxima</button>
                        </div>

                    </div>
                
                </form>

            </div>

        </div>

    </div>

@endsection

@section('scripts')
    <script src="{{Module::asset('avaliacaodesempenho:js/avaliados/funcionarios.js')}}"></script>
@endsection