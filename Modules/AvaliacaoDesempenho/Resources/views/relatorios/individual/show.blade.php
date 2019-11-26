@extends('avaliacaodesempenho::template')

@section('style')
<link href="{{Module::asset('avaliacaodesempenho:css/relatorios/individual/show.css')}}" rel="stylesheet">
@endsection

@section('container')

<div class="card">
    
    <div class="card-header result-resume">

        <?php $notafinal = number_format((float)($data['pontuacao']/(count($data['questoes'])*5))*100, 1, '.', '') ?>

        <div>
            <p><b>Avaliação: </b>{{ $data['avaliacao']->nome }}</p>
            <p><b>Avaliador: </b>{{ $data['resultado']->avaliador->funcionario->nome }}</p>
            <p><b>Avaliado: </b>{{ $data['resultado']->avaliado->funcionario->nome }}</p>
            <p><b>Numero de Questões: </b>{{ count($data['questoes']) }}</p>
        </div>

        <div>
            <p><b>Numero de Categorias: </b>{{ count($data['categorias']) }}</p>
            <p><b>Pontuação Total: </b>{{ $notafinal }}/100</p>
                    
            <b>Pontuação por Categoria: </b>
            @foreach ($data['pontuacaoCategoria'] as $key => $categoria)
                @foreach ($data['categorias'] as $aux)
                    @if ($key == $aux->id)
                        <li><b>{{ $aux->nome }}: </b>{{ number_format((float)($data['pontuacaoCategoria'][$key]/($data['ocorrenciaCategorias'][$aux->id]*5))*100, 1, '.', '') }}/100</li>
                    @endif
                @endforeach
            @endforeach
        </div>

    </div>

    <div class="card-body">

        <div class='card-body-header'>
            
            <h3>Questões</h3>

            <h5>
                <b>Resultado:</b>
                @if ($notafinal <= 20)
                    Insatisfatório
                @elseif ($notafinal <= 40)
                    Satisfatório
                @elseif ($notafinal <= 60)
                    Bom
                @elseif ($notafinal <= 80)
                    Ótimo
                @else
                    Excelente
                @endif
            </h5>

        </div>

        @foreach ($data['questoes'] as $questao)
    
            <hr>

            <div>

                <b>{{ $questao->enunciado }}</b>

                <br>
                <br>

                <p>Resposta:</p>
                <ul class='opt-list'>
                    @if ($data['respostas'][$questao->id] == 1)
                        <li class='question'>
                            <p>a)</p>
                            <i class='material-icons'>star</i>
                            <i class='material-icons'>star_border</i>
                            <i class='material-icons'>star_border</i>
                            <i class='material-icons'>star_border</i>
                            <i class='material-icons'>star_border</i>
                        </li>
                    @endif

                    @if ($data['respostas'][$questao->id] == 2)
                        <li class='question'>
                            <p>b)</p>
                            <i class='material-icons'>star</i>
                            <i class='material-icons'>star</i>
                            <i class='material-icons'>star_border</i>
                            <i class='material-icons'>star_border</i>
                            <i class='material-icons'>star_border</i>
                        </li>
                    @endif

                    @if ($data['respostas'][$questao->id] == 3)
                        <li class='question'>
                            <p>c)</p>
                            <i class='material-icons'>star</i>
                            <i class='material-icons'>star</i>
                            <i class='material-icons'>star</i>
                            <i class='material-icons'>star_border</i>
                            <i class='material-icons'>star_border</i>
                        </li>
                    @endif

                    @if ($data['respostas'][$questao->id] == 4)
                        <li class='question'>
                            <p>d)</p>
                            <i class='material-icons'>star</i>
                            <i class='material-icons'>star</i>
                            <i class='material-icons'>star</i>
                            <i class='material-icons'>star</i>
                            <i class='material-icons'>star_border</i>
                        </li>
                    @endif

                    @if ($data['respostas'][$questao->id] == 5)
                        <li class='question'>
                            <p>e)</p> 
                            <i class='material-icons'>star</i>
                            <i class='material-icons'>star</i>
                            <i class='material-icons'>star</i>
                            <i class='material-icons'>star</i>
                            <i class='material-icons'>star</i>
                        </li>
                    @endif
                </ul>

            </div>

        @endforeach

    </div>
    
</div>

@endsection

@section('scripts')
<!-- <script src="{{Module::asset('avaliacaodesempenho:js/relatorios/_individual.js')}}"></script> -->
@endsection