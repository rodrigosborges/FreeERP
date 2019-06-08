@extends('template')
@section('content')
                
    <form action="{{ $data['url'] }}" method="POST">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif

        <h3>Fornecedor</h3>
        <div class="form-group">
            <label for="nome" class="control-label">Nome do Fornecedor</label>
            <input type="text" required name="fornecedor[nome]" id="nome" class="form-control" value="{{ $data['model'] ? $data['model']->nome : old('nome', "") }}">
            <label class="errors"> {{ $errors->first('fornecedor.nome') }} </label>
        </div>

        <div class="form-group">
            <label for="email" class="control-label">E-mail</label>
            <input type="email" required name="email[email]" id="email" class="form-control" value="{{ $data['model'] ? $data['model']->email : old('email', "") }}">
            <label class="errors"> {{ $errors->first('email.email') }} </label>
        </div>

        <h2>Endereço</h2>

        <div class="form-group">
            <label for="logradouro" class="control-label">Logradouro</label>
            <input type="text" required name="endereco[logradouro]" id="logradouro" class="form-control" value="{{ $data['model'] ? $data['model']->logradouro : old('logradouro', "") }}">
            <label class="errors"> {{ $errors->first('logradouro') }} </label>
        </div>

        <div class="form-group">
            <label for="numero" class="control-label">Número</label>
            <input type="text" required name="endereco[numero]" id="numero" class="form-control" value="{{ $data['model'] ? $data['model']->numero : old('numero', "") }}">
            <label class="errors"> {{ $errors->first('numero') }} </label>
        </div>

        <div class="form-group">
            <label for="bairro" class="control-label">Bairro</label>
            <input type="text" required name="endereco[bairro]" id="bairro" class="form-control" value="{{ $data['model'] ? $data['model']->bairro : old('bairro', "") }}">
            <label class="errors"> {{ $errors->first('bairro') }} </label>
        </div>


        <div class="form-group">
            <label for="cidade" class="control-label">Cidade</label>
            <input type="text" required name="endereco[cidade]" id="cidade" class="form-control" value="{{ $data['model'] ? $data['model']->cidade : old('cidade', "") }}">
            <label class="errors"> {{ $errors->first('cidade') }} </label>
        </div>

        <div class="form-group">
            <label for="uf" class="control-label">UF</label>
            <input type="text" required name="endereco[uf]" id="uf" class="form-control" value="{{ $data['model'] ? $data['model']->uf : old('uf', "") }}">
            <label class="errors"> {{ $errors->first('uf') }} </label>
        </div>

        <div class="form-group">
            <label for="cep" class="control-label">CEP</label>
            <input type="text" required name="endereco[cep]" id="cep" class="form-control" value="{{ $data['model'] ? $data['model']->cep : old('cep', "") }}">
            <label class="errors"> {{ $errors->first('cep') }} </label>
        </div>

        <div class="form-group">
            <label for="complemento" class="control-label">Complemento</label>
            <input type="text" required name="endereco[complemento]" id="complemento" class="form-control" value="{{ $data['model'] ? $data['model']->complemento : old('complemento', "") }}">
            <label class="errors"> {{ $errors->first('complemento') }} </label>
        </div>
        
        <div class="form-group">
            <label for="tipo" class="control-label">Tipo de Telefone</label>
            <input type="text" required name="telefone[tipo]" id="tipo" class="form-control" value="{{ $data['model'] ? $data['model']->tipo : old('tipo', "") }}">
            <label class="errors"> {{ $errors->first('tipo') }} </label>
        </div>



        <div class="form-group">
            <label for="numero" class="control-label">Número</label>
            <input type="text" required name="telefone[numero]" id="numero" class="form-control" value="{{ $data['model'] ? $data['model']->numero : old('numero', "") }}">
            <label class="errors"> {{ $errors->first('numero') }} </label>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success"> {{ $data['button'] }} </button> 
            <a class="btn btn-light" href="{{ url('compra/fornecedor') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
        </div>
    </form>

@endsection