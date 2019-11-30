@extends('template')
@section('content')

    <div class="card">
    <div class="card-header d-flex justify-content-center"><h3>{{$data['title']}}</h3></div>
    <div class="card-body">
        <h5>{{$data['vaga']->cargo->nome}}</h5>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan='2'>Dados Gerais</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><b>Regime de Contratação:</b> {{strtoupper($data['vaga']->regime)}}</td>
                    <td><b>Salário:</b> {{$data['vaga']->salario}}</td>
                </tr>
                <tr>
                    <td>
                    <b>Benefícios:</b>
                    @foreach($data['vaga']->beneficios()->get() as $beneficio)
                        {{$beneficio->nome.' '}} 
                    @endforeach
                    </td>
                    <td><b>Escolaridade:</b> Ensino {{$data['vaga']->escolaridade}}</td>
                </tr>
                <tr>
                    <td colspan='2'><b>Especificações:</b> {{$data['vaga']->especificacoes}}</td>
                </tr>
                <tr>
                    <td colspan='2'><b>Descrição:</b> {{$data['vaga']->descricao}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col col-sm-6">
                <a class="btn  btn-dark " href="{{ url('recrutamento/vagasDisponiveis') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
            </div>
            <div class="col col-sm-6 ">
                <a href="{{ url('recrutamento/candidato/novo/'.$data['vaga']->id) }}" class="btn btn-success float-right"> {{ $data['button'] }} </a> 
            </div>
        </div>
    </div>

    </div>
@endsection
@section('footer')
    
@endsection