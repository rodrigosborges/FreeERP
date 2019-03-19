@extends('template.main')

@section('content')
                
    <form action="{{ $data['url'] }}" method="POST">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="nome" class="control-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $data['model'] ? $data['model']->nome : old('nome', "") }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success"> {{ $data['button'] }} </button> 
            <a class="btn btn-light" href="{{ url('/professor') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
        </div>

    </form>

@endsection