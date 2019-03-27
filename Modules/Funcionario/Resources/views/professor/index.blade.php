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
        @foreach($data['professores'] as $professor)
            <tr>
                <td>{{$professor->nome}}</td>
                <td>
                    <form action="{{url('professor', [$professor->id])}}" method="POST">
                        {{method_field('DELETE')}}
                        {{ csrf_field() }}
                        <a class="btn btn-warning" href='{{ url("professor/$professor->id/edit") }}'>Editar</a> 
                        @if(!$professor->aulas()->count())
                            <input type="submit" class="btn btn-danger" value="Delete"/>
                        @endif
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a class="btn btn-success" href="{{ url('professor/create') }}">Novo professor</a>
@endsection