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
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $data['model'] ? $data['model']->nome : old('nome', '') }}">
            <label class="errors"> {{ $errors->first('nome') }} </label>
        </div>

        <div class="col-md-4">
            <label for="data_nascimento" class="control-label">Data de Nascimento</label>
            <input type="text" name="data_nascimento" id="data_nascimento" class="form-control" value="{{ $data['model'] ? $data['model']->data_nascimento : old('data_nascimento', '') }}">
            <label class="errors"> {{ $errors->first('data_nascimento') }} </label>
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
            <select required name="estado_civil_id" class="form-control">
                <option value="">Selecione</option>
                @foreach($data['estado_civil'] as $item)
                    <option value="{{ $item->id }}" {{ ($data['model'] && $item->id == $data['model']->estado_civil_id ) ? 'selected' : '' }}> {{ $item->nome }} </option>
                @endforeach 
            </select>
        </div>
        <div class="col-md-3">
            <label for="cargo" class="control-label">Cargo</label>
            <select required name="cargo_id" class="form-control">
                <option value="">Selecione</option>
                @foreach($data['cargos'] as $item)
                    <option value="{{ $item->id }}" {{ ($data['model'] && $item->id == $data['model']->cargo_id ) ? 'selected' : '' }}> {{ $item->nome }} </option>
                @endforeach 
            </select>
        </div>
        <div class="col-md-4">
            <label for="data_admissao" class="control-label">Data de Admissão</label>
            <input type="text" name="data_admissao" id="data_admissao" class="form-control" value="{{ $data['model'] ? $data['model']->data_admissao : old('data_admissao', '') }}">
            <label class="errors"> {{ $errors->first('data_admissao') }} </label>
        </div>
    </div>

    <strong><h6 class="mt-4 mb-3">Endereço</h6></strong>
    <hr>
    <div class="form-group row">
        <div class="col-md-2">
            <label for="cep" class="control-label">CEP</label>
            <input type="text" name="endereco[cep]" id="cep" class="form-control" value="{{ $data['model'] ? $data['model']->cep : old('cep', '') }}">
            <label class="errors"> {{ $errors->first('endereco.cep') }} </label>
        </div>
    </div>
</form>
@endsection