@extends('template.main')
@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($data['aulas'] as $aula)
            <tr>
                <td>{{$aula->nome}}</td>
                <td>
                    <form action="{{url('aula', [$aula->id])}}" method="POST">
                        {{method_field('DELETE')}}
                        {{ csrf_field() }}
                        <a class="btn btn-warning" href='{{ url("aula/$aula->id/edit") }}'>Editar</a> 
                        <input type="submit" class="btn btn-danger" value="Delete"/>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a class="btn btn-success" href="{{ url('aula/create') }}">Nova aula</a>
@endsection