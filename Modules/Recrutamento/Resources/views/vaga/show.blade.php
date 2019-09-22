@extends('template')
@section('content')

    <div class="card ">
    <div class="card-header"><h3>{{$data['title']}}</h3></div>
    <div class="card-body">

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
            <div class="row mb-3">
                <div class="col-md-3">
                    <h4>Salário:</h4>
                    <p>{{$data['vaga']->salario}}</p>
                </div>
                <div class="col-md-3">
                    <h5>Ecolaridade:</h5>
                    <p>Ensino {{$data['vaga']->escolaridade == 'medio' ? 'médio' : $data['vaga']->escolaridade}}</p>
                </div>
                <div class="col-md-3">
                    <h5>Regime de Contratação:</h5>
                    <p>{{$data['vaga']->regime}}</p>
                </div>
                <div class="col-md-3">
                    <h5>Benefícios:</h5>
                    <p>{{$data['vaga']->beneficios}}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <h5>Descrição:</h5>
                    <p>{{$data['vaga']->descricao}}</p>
                </div>
            </div>
            <br>
            <div class="row mb-3 center">
                <div class="col-md-12">
                    <h5>Especificações:</h5>
                    <p>{{$data['vaga']->especificacoes}}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <a class="btn btn-light mr-sm-3" href="{{ url('recrutamento/vagasDisponiveis') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
            <a  href="{{ url('recrutamento/candidato/novo/'.$data['vaga']->id) }}" class="btn btn-success "> {{ $data['button'] }} </a> 
        </div>

    </div>
    </div>
    </div>
    
@endsection