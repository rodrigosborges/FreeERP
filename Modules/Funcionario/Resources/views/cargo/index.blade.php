@extends('funcionario::template')

@section('title','Lista de cargos')

@section('body')
    <div class="text-right">
        <a class="btn btn-success" href="{{ url('funcionario/cargo/create') }}">Novo cargo</a>
    </div>
    <br>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['cargos'] as $cargo)
                        <tr>
                            <td>{{$cargo->nome}}</td>
                            <td>
                                <form action="{{url('funcionario/cargo', [$cargo->id])}}" method="POST">
                                    {{method_field('DELETE')}}
                                    {{ csrf_field() }}
                                    <a class="btn btn-warning" href='{{ url("funcionario/cargo/$cargo->id/edit") }}'>Editar</a> 
                                    @if(!$cargo->funcionarios()->count())
                                        <input type="submit" class="btn btn-danger" value="Delete"/>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection