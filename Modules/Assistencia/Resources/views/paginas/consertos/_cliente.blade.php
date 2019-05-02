
<div class="form-group row">
  <div class="input-group col">
    <div class="input-group-prepend">
      <span class="input-group-text" id="nome"><i class="material-icons">person</i></span>
    </div>
    <input class="form-control" name="nome" type="text" placeholder="Nome completo" value="{{ isset($cliente->nome) ? $cliente->nome : old('nome', '') }}">
  </div>
  <div class="input-group col">
    <div class="input-group-prepend">
      <span class="input-group-text" id="cpf"><i class="material-icons">account_box</i></span>
    </div>
    <input type="text" class="form-control cpf-mask" name="cpf" placeholder="000.000.000-00" readonly value="{{ isset($cliente->cpf) ? $cliente->cpf : old('cpf', '') }}">
<!--
    <input type="text" class="form-control input-md" name="cpf" placeholder="XXX.XXX.XXX-XX" readonly value="{{isset($cliente->cpf) ? $cliente->cpf : ''}}">
-->
  </div>
</div>

<div class="form-group row">
  <div class="input-group col">
    <div class="input-group-prepend">
      <span class="input-group-text" id="email"><i class="material-icons">email</i></span>
    </div>
    <input class="form-control" type="email" name="email" placeholder="E-mail"  readonly value="{{ isset($cliente->email) ? $cliente->email : old('email', '') }}">
  </div>

  <div class="input-group col">
    <div class="input-group-prepend">
      <span class="input-group-text" id="cel_numero"><i class="material-icons">phone</i></span>
    </div>
    <input id="celnumber" name="celnumero" class="form-control input-md telefone" readonly placeholder="(XX) X XXXX-XXXX"  type="text" maxlength="11"
    value="{{isset($cliente->celnumero) ? $cliente->celnumero : old('celnumero', '')}}">
  </div>

</div>
