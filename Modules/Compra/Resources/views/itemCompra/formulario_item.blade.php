@extends('template')
@section('content')
                
    <form action="{{ $data['url'] }}" method="POST">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif

        <h3>Item</h3>
        <div class="form-group">
            <label for="nome_produto" class="control-label">Nome do Produto</label>
            <input type="text" required name="nome"  id="nome" class="form-control" value="{{ $data['model'] ? $data['model']->nome : old('nome', "") }}">
            <label class="errors"> {{ $errors->first('nome_produto') }} </label>
        </div>

        <div class="form-group">
            <label for="valor_estimado" class="control-label">Valor Estimado</label>
            <input type="number"  step="0.01" required name="valor_estimado" id="valor_estimado" class="form-control" value="{{ $data['model'] ? $data['model']->valor_estimado : old('valor_estimado', "") }}">
            <label class="errors"> {{ $errors->first('valor_estimado') }} </label>
        </div>

        <div class="form-group">
            <label for="caracteristicas" class="control-label">Caracteristicas</label>
            <input type="text" required name="caracteristicas" id="caracteristicas" class="form-control" value="{{ $data['model'] ? $data['model']->caracteristicas : old('caracteristicas', "") }}">
            <label class="errors"> {{ $errors->first('caracteristicas') }} </label>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-success"> {{ $data['button'] }} </button> 
            <a class="btn btn-light" href="{{ url('compra/itemCompra') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
        </div>
    </form>

@endsection