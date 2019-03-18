@extends('template.main')
@section('content')

    <ul class="list-group">
        <a href="{{ url('aluno') }}" class="list-group-item text-center link"><h4>Aluno</h4></a>
        <a href="{{ url('professor') }}" class="list-group-item text-center link"><h4>Professor</h4></a>
        <a href="{{ url('aula') }}" class="list-group-item text-center link"><h4>Aula</h4></a>
    </ul>

@endsection
