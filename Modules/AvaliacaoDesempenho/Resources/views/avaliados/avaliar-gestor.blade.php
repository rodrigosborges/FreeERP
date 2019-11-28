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

                    <div>

                        @foreach($questoes as $key => $questao)
    
                            <div class="card questao tab">
    
                                <div class="card-body">
    
                                <b>{{ $questao->enunciado }}</b>
                            
                            <hr>
                    
                            <b>Resposta:</b>
                            <ul>

                                <br>
                                <button class='btn btn-lg' type="button" onclick="control(this)">
                                    <label class='question'>
                                        <i class='material-icons md-48 star'>star_border</i>
                                        <i class='material-icons md-48 star'>star_border</i>
                                        <i class='material-icons md-48 star'>star_border</i>
                                        <i class='material-icons md-48 star'>star_border</i>
                                        <i class='material-icons md-48 star'>star_border</i>
                                    </label>
                                </button>

                                <input class='input' type="hidden" id="{{$key}}" name='avaliacao[questoes][{{$questao->id}}]' value='' required>
                                
                            </ul>

                            <hr>

                            <p>{{ $questao->descricao }}</p>
    
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
    <script src="{{Module::asset('avaliacaodesempenho:js/avaliados/gestores.js')}}"></script>
@endsection