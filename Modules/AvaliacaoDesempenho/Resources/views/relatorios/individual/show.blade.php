@extends('avaliacaodesempenho::template')

@section('style')
<link href="{{Module::asset('avaliacaodesempenho:css/relatorios/individual/show.css')}}" rel="stylesheet">
@endsection

@section('container')

<div class="card">

    <div class="card-header result-resume">

        <div>
            <p><b>Avaliação: </b>{{ $data['avaliacao']->nome }}</p>
            <p><b>Avaliador: </b>{{ $data['resultado']->avaliador->funcionario->nome }}</p>
            <p><b>Avaliado: </b>{{ $data['resultado']->avaliado->funcionario->nome }}</p>
            <p><b>Numero de Questões: </b>{{ count($data['questoes']) }}</p>
        </div>

        <div>
            <p><b>Numero de Categorias: </b>{{ count($data['categorias']) }}</p>
            <p><b>Pontuação Total: </b>{{ $data['pontuacao'] }}/{{ count($data['questoes'])*5 }}</p>
            <p><b>Pontuação por Categoria: </b>
                @foreach ($data['pontuacaoCategoria'] as $key => $categoria)
                    @foreach ($data['categorias'] as $aux)
                        @if ($key == $aux->id)
                            <li><b>{{ $aux->nome }}: </b>{{ $data['pontuacaoCategoria'][$key] }}</li>
                        @endif
                    @endforeach
                @endforeach
            </p>
        </div>

    </div>

    <div class="card-body">
        <h3>QUESTÕES</h3>

        @foreach ($data['questoes'] as $questao)

            <div>

                <hr>

                <b>Categoria:</b>
                <p>{{ $questao->categoria->nome }}</p>

                <b>Enunciado:</b>
                <p>{{ $questao->enunciado }}</p>

                <b>Alternativas:</b>
                <ul class='opt-list'>
                    @if ($data['respostas'][$questao->id] == $questao->opt1)
                        <li style='color: red'><b>a)</b> {{ $questao->opt1 }}</li>
                    @else
                        <li><b>a)</b> {{ $questao->opt1 }}</li>
                    @endif

                    @if ($data['respostas'][$questao->id] == $questao->opt2)
                        <li style='color: red'><b>b)</b> {{ $questao->opt2 }}</li>
                    @else
                        <li><b>b)</b> {{ $questao->opt2 }}</li>
                    @endif

                    @if ($data['respostas'][$questao->id] == $questao->opt3)
                        <li style='color: red'><b>c)</b> {{ $questao->opt3 }}</li>
                    @else
                        <li><b>c)</b> {{ $questao->opt3 }}</li>
                    @endif

                    @if ($data['respostas'][$questao->id] == $questao->opt4)
                        <li style='color: red'><b>d)</b> {{ $questao->opt4 }}</li>
                    @else
                        <li><b>d)</b> {{ $questao->opt4 }}</li>
                    @endif

                    @if ($data['respostas'][$questao->id] == $questao->opt5)
                        <li style='color: red'><b>e)</b> {{ $questao->opt5 }}</li>
                    @else
                        <li><b>e)</b> {{ $questao->opt5 }}</li>
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