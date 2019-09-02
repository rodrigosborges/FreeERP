@extends('template')
@section('content')

    <div class="card ">
    <div class="card-header"><h3>Vaga: {{$data['vaga']->cargo}}</h3></div>
    <div class="card-body">

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Salário:</h5>
                    <h5>R$ {{str_replace('.',',',$data['vaga']->salario)}}</h5>
                </div>
                <div class="col-md-6">
                    <h5>Ecolaridade:</h5>
                    <h5>Ensino {{$data['vaga']->escolaridade}}</h5>
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

    </div>
    </div>
    </div>
    
@endsection