<input type="hidden" name="idCliente" value="{{isset($conserto->idCliente) ? $conserto->idCliente : old('idCliente', '')}}">
<div class="form-group row">
  <div class="input-group col-12">
    <div class="input-group-prepend">
      <span class="input-group-text" id="nome"><i class="material-icons">link_off</i></span>
    </div>
    <input class="form-control" name="selecionarCliente" type="text" placeholder="Escolher cliente" >
  </div>
</div>
<div class="row">
  <div class="form-group col-lg-6 col-sm-12">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" id="nome"><i class="material-icons">person</i></span>
      </div>
      <input required class="form-control" name="nome" type="text" placeholder="Nome completo" readonly value="{{ isset($conserto->cliente->nome) ? $conserto->cliente->nome : old('nome', '') }}">
    </div>
  </div>
  <div class="form-group col-lg-6 col-sm-12">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" id="cpf"><i class="material-icons">account_box</i></span>
      </div>
      <input required type="text" class="form-control cpf-mask" name="cpf" placeholder="000.000.000-00" readonly value="{{ isset($conserto->cliente->cpf) ? $conserto->cliente->cpf : old('cpf', '') }}">
    </div>
  </div>
</div>

<div class="form-group row">
  <div class="form-group col-lg-6 col-sm-12">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" id="email"><i class="material-icons">email</i></span>
      </div>
      <input class="form-control" type="email" name="email" placeholder="E-mail"  readonly value="{{ isset($conserto->cliente->email) ? $conserto->cliente->email : old('email', '') }}">
    </div>
  </div>
  <div class="form-group col-lg-6 col-sm-12">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" id="cel_numero"><i class="material-icons">phone</i></span>
      </div>
      <input id="celnumber" name="celnumero" class="form-control input-md telefone" readonly placeholder="(XX) X XXXX-XXXX"  type="text" maxlength="11"
      value="{{ isset($conserto->cliente->celnumero) ? $conserto->cliente->celnumero : old('celnumero', '') }}">
    </div>
  </div>
</div>
