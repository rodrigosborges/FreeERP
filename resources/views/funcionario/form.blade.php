@extends('template.main')

@section('content')
<form action="{{ $data['url'] }}" method="POST">
    {{ csrf_field() }}
    @if($data['model'])
        @method('PUT')
    @endif

    <strong><h6 class="mb-3">Dados Básicos</h6></strong>
    <hr>
    <div class="form-group row">
        <div class="col-md-8">
            <label for="nome" class="control-label">Nome</label>
            <input type="text" name="funcionario[nome]" id="nome" class="form-control" value="{{ $data['model'] ? $data['model']->nome : old('nome', '') }}">
            <label class="errors"> {{ $errors->first('funcionario.nome') }} </label>
        </div>

        <div class="col-md-4">
            <label for="data_nascimento" class="control-label">Data de Nascimento</label>
            <input type="text" name="funcionario[data_nascimento]" id="data_nascimento" class="form-control" value="{{ $data['model'] ? $data['model']->data_nascimento : old('data_nascimento', '') }}">
            <label class="errors"> {{ $errors->first('funcionario.data_nascimento') }} </label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-2">
            <label for="sexo" class="control-label">Sexo</label>
            <select required name="sexo_id" class="form-control">
                    <option value="">Selecione</option>
                    <option value="">Masculino</option>
                    <option value="">Feminino</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="estado_civil" class="control-label">Estado Civil</label>
            <select required name="funcionario[estado_civil]" class="form-control">
                <option value="">Selecione</option>
                @foreach($data['estado_civil'] as $item)
                    <option value="{{ $item->id }}" {{ ($data['model'] && $item->id == $data['model']->estado_civil_id ) ? 'selected' : '' }}> {{ $item->nome }} </option>
                @endforeach 
            </select>
        </div>
        <div class="col-md-3">
            <label for="cargo" class="control-label">Cargo</label>
            <select required name="funcionario[cargo]" class="form-control">
                <option value="">Selecione</option>
                @foreach($data['cargos'] as $item)
                    <option value="{{ $item->id }}" {{ ($data['model'] && $item->id == $data['model']->cargo_id ) ? 'selected' : '' }}> {{ $item->nome }} </option>
                @endforeach 
            </select>
        </div>
        <div class="col-md-4">
            <label for="data_admissao" class="control-label">Data de Admissão</label>
            <input type="text" name="funcionario[data_admissao]" id="data_admissao" class="form-control" value="{{ $data['model'] ? $data['model']->data_admissao : old('data_admissao', '') }}">
            <label class="errors"> {{ $errors->first('funcionario.data_admissao') }} </label>
        </div>
    </div>

    <strong><h6 class="mt-4 mb-3">Endereço</h6></strong>
    <hr>
    <div class="form-group row">
        <div class="col-md-2">
            <label for="cep" class="control-label">CEP</label>
            <input type="text" name="endereco[cep]" id="cep" class="form-control" value="{{ $data['model'] ? $data['model']->cep : old('endereco.cep', '') }}">
            <label class="errors"> {{ $errors->first('endereco.cep') }} </label>
        </div>
        <div class="col-md-2">
            <label for="estado" class="control-label">Estado</label>
            <select required name="endereco[estado]" class="form-control">
                <option value="">Selecione</option>
                @foreach($data['estados'] as $item)
                    <option value="{{ $item->id }}" {{ ($data['model'] && $item->id == $data['model']->estado_id ) ? 'selected' : '' }}> {{ $item->nome }} </option>
                @endforeach 
            </select>
        </div>
        <div class="col-md-4">
            <label for="cidade" class="control-label">Cidade</label>
            <select required name="endereco[cidade]" class="form-control">
                <option value="">Selecione</option>
                @foreach($data['cidades'] as $item)
                    <option value="{{ $item->id }}" {{ ($data['model'] && $item->id == $data['model']->cidade_id ) ? 'selected' : '' }}> {{ $item->nome }} </option>
                @endforeach 
            </select>
        </div>
        <div class="col-md-4">
            <label for="bairro" class="control-label">Bairro</label>
            <input type="text" name="endereco[bairro]" id="bairro" class="form-control" value="{{ $data['model'] ? $data['model']->bairro : old('endereco.bairro', '') }}">
            <label class="errors"> {{ $errors->first('endereco.bairro') }} </label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-10">
            <label for="logradouro" class="control-label">Logradouro</label>
            <input type="text" name="endereco[logradouro]" id="logradouro" class="form-control" value="{{ $data['model'] ? $data['model']->logradouro : old('endereco.logradouro', '') }}">
            <label class="errors"> {{ $errors->first('endereco.logradouro') }} </label>
        </div>
        <div class="col-md-2">
            <label for="numero" class="control-label">Número</label>
            <input type="text" name="endereco[numero]" id="numero" class="form-control" value="{{ $data['model'] ? $data['model']->numero : old('endereco.numero', '') }}">
            <label class="errors"> {{ $errors->first('endereco.numero') }} </label>
        </div>
    </div>
</form>
@endsection