@extends('template')
@section('content')
                
    <form action="{{ $data['url'] }}" method="POST">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif

        <h3>Vaga</h3>
        <div class="form-group">
            <label for="cargo" class="control-label">Cargo</label>
            <input type="text" name="cargo" id="cargo" class="form-control" value="{{ $data['model'] ? $data['model']->cargo : old('cargo', "") }}">
            <label class="errors"> {{ $errors->first('cargo') }} </label>
        </div>

        <div class="form-group">
            <label for="salario" class="control-label">Salário</label>
            <input type="text" name="salario" id="salario" class="form-control" value="{{ $data['model'] ? $data['model']->salario : old('salario', "") }}">
            <label class="errors"> {{ $errors->first('salario') }} </label>
        </div>

        <div class="form-group">
            <label for="quantidade" class="control-label">Descrição</label>
            <input type="text" name="descricao" id="descricao" class="form-control" value="{{ $data['model'] ? $data['model']->descricao : old('descricao', "") }}">
            <label class="errors"> {{ $errors->first('descricao') }} </label>
        </div>

        <div class="form-group">
            <label for="quantidade" class="control-label">Escolariodade</label>
            <input type="text" name="escolaridade" id="escolaridade" class="form-control" value="{{ $data['model'] ? $data['model']->escolaridade : old('escolaridade', "") }}">
            <label class="errors"> {{ $errors->first('escolaridade') }} </label>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success"> {{ $data['button'] }} </button> 
            <a class="btn btn-light" href="{{ url('compra/itemCompra') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
        </div>
    </form>

@endsection