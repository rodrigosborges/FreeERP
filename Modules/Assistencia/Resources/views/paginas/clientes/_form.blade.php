<div class="form-group row">
  <div class="input-group col-12">
    <div class="input-group-prepend">
      <span class="input-group-text" id="cliente"><i class="material-icons">person</i></span>
    </div>
    <input required class="form-control" name="nome" type="text" placeholder="Nome completo" value="{{ isset($cliente->nome) ? $cliente->nome : old('nome', '') }}">
  </div>
  <span class="errors"> {{ $errors->first('nome') }} </span>
</div>

<div class="row">
    <div class="form-group col-lg-6 col-sm-12">
      <input required type="text" class="form-control cpf-mask" name="cpf" placeholder="000.000.000-00" value="{{ isset($cliente->cpf) ? $cliente->cpf : old('cpf', '') }}">
      <span class="errors"> {{ $errors->first('cpf') }} </span>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="email"><i class="material-icons">email</i></span>
        </div>
        <input required class="form-control" type="email" name="email" placeholder="E-mail"  value="{{ isset($cliente->email) ? $cliente->email : old('email', '') }}">
      </div>
      <span class="errors"> {{ $errors->first('email') }} </span>
    </div>
</div>

<div class="row">
  <div class="form-group col-md-6 col-sm-12">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" id="nascimento"><i class="material-icons">calendar_today</i></span>
      </div>
      <input required class="form-control" name="data_nascimento" type="date" id="example-date-input" value="{{ isset($cliente->data_nascimento) ? $cliente->data_nascimento : old('data_nascimento', '10-10-2000') }}">
    </div>
  </div>
  <div class="form-group col-md-6 col-sm-12">
    <label required="" class="radio-inline" for="radios-0" >
      <input name="sexo" id="sexo" value="feminino" type="radio" {{isset($cliente->sexo) && $cliente->sexo == 'feminino' ? 'checked' : ''}}>
      Feminino
    </label>
    <label class="radio-inline" for="radios-1">
      <input name="sexo" id="sexo" value="masculino" type="radio" {{isset($cliente->sexo) && $cliente->sexo == 'masculino' ? 'checked' : ''}}>
      Masculino
    </label>
  </div>
</div>

<div class="row">
  <div class="form-group col-xl-6 col-sm-12">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" id="celnumber"><i class="material-icons">smartphone</i></span>
      </div>
      <input required id="celnumber" name="celnumero" class="form-control input-md telefone" placeholder="(XX) X XXXX-XXXX"  type="text" maxlength="11"
      value="{{isset($cliente->celnumero) ? $cliente->celnumero : old('celnumero', '')}}">
    </div>
  </div>
  <div class="form-group col-xl-6 col-sm-12">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" id="telefone"><i class="material-icons">phone</i></span>
      </div>
      <input id="celnumber" name="telefonenumero" class="form-control input-md telefone" placeholder="(XX) X XXXX-XXXX"  type="text" maxlength="11"
      value="{{isset($cliente->telefonenumero) ? $cliente->telefonenumero : old('telefonenumero', '')}}">
    </div>
  </div>
</div>
