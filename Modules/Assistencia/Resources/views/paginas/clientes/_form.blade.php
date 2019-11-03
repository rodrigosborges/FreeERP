<div class="form-group row">
    <div class="input-group col-sm-12">
        <div class="input-group-prepend">
            <span class="input-group-text" id="cliente"><i class="material-icons">person</i></span>
        </div>
        <input required class="form-control" name="nome" type="text" placeholder="Nome completo"
            value="{{ isset($cliente->nome) ? $cliente->nome : old('nome', '') }}">
    </div>
    <span class="error"> {{ $errors->first('nome') }} </span>
</div>

<div class="row">
    <div class="form-group col-lg-6 cl-sm-12">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="cliente"><i class="material-icons">picture_in_picture</i></span>
            </div>
            <input required type="text" class="form-control cpf-mask"  name="cpf"
                placeholder="000.000.000-00 (CPF)" value="{{ isset($cliente->cpf) ? $cliente->cpf : old('cpf', '') }}">
        </div>
        <span class="error"> {{ $errors->first('cpf') }} </span>
    </div>
    <div class="form-group col-lg-6">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="email"><i class="material-icons">email</i></span>
            </div>
            <input required class="form-control" type="email" name="email" placeholder="E-mail"
                value="{{ isset($cliente->email) ? $cliente->email : old('email', '') }}">
        </div>
        <span class="error"> {{ $errors->first('email') }} </span>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 col-sm-12">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="nascimento"><i class="material-icons">calendar_today</i></span>
            </div>
            <input required class="form-control" name="data_nascimento" type="date" id="example-date-input"
                value="{{ isset($cliente->data_nascimento) ? $cliente->data_nascimento : old('data_nascimento', '10-10-2000') }}">
        </div>
        <span class="error"> {{ $errors->first('data_nascimento') }} </span>
    </div>
    

</div>

<div class="row">
    <div class="form-group col-xl-6 col-sm-12">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="celnumber"><i class="material-icons">smartphone</i></span>
            </div>
            <input required id="celnumber" name="celnumero" class="form-control input-md cel_sp"
                placeholder="(XX) X XXXX-XXXX" type="text"
                value="{{isset($cliente->celnumero) ? $cliente->celnumero : old('celnumero', '')}}">
        </div>
        <span class="error"> {{ $errors->first('celnumero') }} </span>
    </div>
    <div class="form-group col-xl-6 col-sm-12">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="telefone"><i class="material-icons">phone</i></span>
            </div>
            <input id="celnumber" name="telefonenumero" class="form-control input-md cel_sp"
                placeholder="(XX) X XXXX-XXXX" type="text"
                value="{{isset($cliente->telefonenumero) ? $cliente->telefonenumero : old('telefonenumero', '')}}">
        </div>
        <span class="error"> {{ $errors->first('telefonenumero') }} </span>
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-3">
        <label for="endereco[cep]">CEP</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="material-icons">map</i></span>
            </div>
            <input type="text" class="form-control cep" name="endereco[cep]" value="{{ old('endereco.cep', isset($cliente) ? $cliente->endereco->cep : '') }}">
            
        </div>
        <span class="error"> {{ $errors->first('endereco.cep') }} </span>
    </div>
    <div class="form-group col-sm-6">
        <label for="endereco[logradouro]">Logradouro</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="material-icons">house</i></span>
            </div>
            <input type="text" class="form-control" name="endereco[logradouro]" value="{{ old('endereco.logradouro', isset($cliente) ? $cliente->endereco->logradouro : '') }}">
        </div>
        <span class="error"> {{ $errors->first('endereco.logradouro') }} </span>
    </div>
    <div class="form-group col-sm-2">
        <label for="endereco[numero]">Número</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="material-icons">house</i></span>
            </div>
            <input type="text" class="form-control" name="endereco[numero]" value="{{ old('endereco.numero', isset($cliente) ? $cliente->endereco->numero : '') }}">
        </div>
        <span class="error"> {{ $errors->first('endereco.numero') }} </span>
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-3">
        <label for="endereco[bairro]">Bairro:</label>
        <div class="input-group">
            <div class="input-group-prepend">
                    <span class="input-group-text"><i class="material-icons">location_city</i></span>
            </div>
            <input type="text" class="form-control" name="endereco[bairro]" value="{{ old('endereco.bairro', isset($cliente) ? $cliente->endereco->bairro : '') }}">
        </div>
        <span class="error"> {{ $errors->first('endereco.bairro') }} </span>
    </div>
    <div class="form-group col-sm-3">
        <label for="endereco[estado_id]">Estado</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="material-icons">location_city</i></span>
            </div>
            <select cidade="{{ old('endereco.cidade_id', isset($cliente) ? $cliente->endereco->cidade_id : "")}}" name="endereco[estado_id]" class="form-control" id="estado">
                <option value="" disabled selected>Selecione</option>
                @foreach($estados as $estado)
                    <option value="{{$estado->id}}" uf="{{$estado->uf}}" {{ old('endereco.estado_id', isset($cliente) ? $cliente->endereco->cidade->estado_id : "") == $estado->id ? 'selected' : '' }}>{{ $estado->nome }}</option>
                
                @endforeach
            </select>
        </div>  
        <span class="error"> {{ $errors->first('endereco.estado_id') }} </span>
    </div>
    <div class="form-group col-sm-3">
        <label for="endereco[cidade_id]">Cidade</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="material-icons">location_city</i></span>
            </div>
            <select name="endereco[cidade_id]" class="form-control" id="cidade"></select>
            
        </div>
        <span class="error"> {{ $errors->first('endereco.cidade_id') }} </span>
    </div>
</div>