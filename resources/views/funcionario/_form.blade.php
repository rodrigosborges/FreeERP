@extends('template.main')

@section('content')
                
    <form action="{{ $data['url'] }}" method="POST">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif

        <h3>Dados do aluno </h3>
        <div class="form-group">
            <label for="nome" class="control-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $data['model'] ? $data['model']->nome : old('nome', "") }}">
            <label class="errors"> {{ $errors->first('nome') }} </label>
        </div>
        <div class="form-group">
            <label for="prontuario" class="control-label">Prontuario</label>
            <input type="text" name="prontuario" id="prontuario" class="form-control" value="{{ $data['model'] ? $data['model']->prontuario : old('prontuario', "") }}">
            <label class="errors"> {{ $errors->first('prontuario') }} </label>
        </div>

        <h3> Endereço </h3>

        <div class="form-group">
            <label for="rua" class="control-label">Rua</label>
            <input type="text" name="rua" id="rua" class="form-control" value="{{ $data['model'] ? $data['model']->endereco->rua : old('rua', "") }}">
            <label class="errors"> {{ $errors->first('rua') }} </label>
        </div>

        <div class="form-group">
            <label for="numero" class="control-label">Número</label>
            <input type="text" name="numero" id="numero" class="form-control" value="{{ $data['model'] ? $data['model']->endereco->numero : old('numero', "") }}">
            <label class="errors"> {{ $errors->first('numero') }} </label>
        </div>

        <div class="form-group">
            <label for="bairro" class="control-label">Bairro</label>
            <input type="text" name="bairro" id="bairro" class="form-control" value="{{ $data['model'] ? $data['model']->endereco->bairro : old('bairro', "") }}">
            <label class="errors"> {{ $errors->first('bairro') }} </label>
        </div>
                                                        
        <div class="form-group">
            <button type="submit" class="btn btn-success"> {{ $data['button'] }} </button> 
            <a class="btn btn-light" href="{{ url('/aluno') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
        </div>
    </form>

@endsection