@extends('funcionario::template')

@section('title','Lista de funcionários')

@section('body')
    <div class="text-right">
        <a class="btn btn-success" href="{{ url('funcionario/funcionario/create') }}">Novo Funcionário</a>
    </div>
    <br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Cargo</th>
                <th>Data de Admissão</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['funcionarios'] as $funcionario)
            <tr>
                <td>{{$funcionario->nome}}</td>
                <td>XXX.XXX.XXX-XX</td>
                <td>{{$funcionario->cargo->nome}}</td>
                <td>{{$funcionario->data_admissao}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$data['funcionarios']->links()}}
  
@endsection

@section('script')

@endsection