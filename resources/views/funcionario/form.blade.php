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
</form>