
<div class="form-group row">
  <div class="input-group col">
    <div class="input-group-prepend">
      <span class="input-group-text" id="nome"><i class="material-icons">person</i></span>
    </div>
    <input class="form-control" name="nome" type="text" placeholder="Nome completo" value="{{isset($cliente->nome) ? $cliente->nome : ''}}">
  </div>
  <div class="input-group col">
    <div class="input-group-prepend">
      <span class="input-group-text" id="cpf"><i class="material-icons">account_box</i></span>
    </div>
    <input type="text" class="form-control input-md" name="cpf" placeholder="XXX.XXX.XXX-XX" readonly value="{{isset($cliente->cpf) ? $cliente->cpf : ''}}">
  </div>
</div>

<div class="form-group row">
  <div class="input-group col">
    <div class="input-group-prepend">
      <span class="input-group-text" id="email"><i class="material-icons">email</i></span>
    </div>
    <input class="form-control" type="email" name="email" placeholder="E-mail" id="email-input" readonly value="{{isset($cliente->email) ? $cliente->email : ''}}">
  </div>

  <div class="input-group col">
    <div class="input-group-prepend">
      <span class="input-group-text" id="cel_numero"><i class="material-icons">phone</i></span>
    </div>
    <input id="cel_numero" type="text" name="celnumero" class="form-control input-md" readonly placeholder="(XX) X XXXX-XXXX" onkeypress="return isNumberKey(event)"maxlength="11"
    OnKeyPress="formatar('## #####-####', this)" value="{{isset($cliente->telefonenumero) ? $cliente->telefonenumero : ''}}">
  </div>

</div>
