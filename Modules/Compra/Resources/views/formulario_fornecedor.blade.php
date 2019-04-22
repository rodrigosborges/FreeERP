@extends('template')
@section('content')
                
    <form action="{{ $data['url'] }}" method="POST">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif

        <h3>Item</h3>
        <div class="form-group">
            <label for="nome_fornecedor" class="control-label">Nome do Fornecedor</label>
            <input type="text" name="nome_fornecedor" id="nome_fornecedor" class="form-control" value="{{ $data['model'] ? $data['model']->nome_fornecedor : old('nome_fornecedor', "") }}">
            <label class="errors"> {{ $errors->first('nome_fornecedor') }} </label>
        </div>

        <div class="form-group">
            <label for="email" class="control-label">E-mail do Fornecedor</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ $data['model'] ? $data['model']->email : old('email', "") }}">
            <label class="errors"> {{ $errors->first('email') }} </label>
        </div>

        <div class="form-group">
            <label for="endereco" class="control-label">Endereço do Fornecedor</label>
            <input type="text" name="endereco" id="endereco" class="form-control" value="{{ $data['model'] ? $data['model']->endereco : old('endereco', "") }}">
            <label class="errors"> {{ $errors->first('endereco') }} </label>
        </div>
        
        <div class="form-group">
            <label for="telefone" class="control-label">Telefone</label>
            <input type="text" name="telefone" id="telefone" class="form-control" value="{{ $data['model'] ? $data['model']->telefone : old('telefone', "") }}">
            <label class="errors"> {{ $errors->first('telefone') }} </label>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success"> {{ $data['button'] }} </button> 
            <a class="btn btn-light" href="{{ url('compra/fornecedor') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
        </div>
    </form>

@endsection