<div class="row">
  <div class="input-group col">
    <div class="input-group-prepend">
      <span class="input-group-text" id="cliente"><i class="material-icons">person</i></span>
    </div>
    <input class="form-control" name="nome" type="text" placeholder="Nome completo" value="{{isset($cliente->nome) ? $cliente->nome : ''}}">
  </div>
  <div class="input-group col">
    <div class="input-group-prepend">
      <span class="input-group-text" id="cliente"><i class="material-icons">account_box</i></span>
      <input type="text" class="form-control cpf-mask" name="cpf" placeholder="XXX.XXX.XXX-XX" value="{{isset($cliente->cpf) ? $cliente->cpf : ''}}">
    </div>

  </div>

</div>

<div class="row">
  <div class="input-group col">
    <div class="input-group-prepend">
      <span class="input-group-text" id="email"><i class="material-icons">email</i></span>
    </div>
    <input class="form-control" type="email" name="email" placeholder="E-mail" id="email-input" value="{{isset($cliente->email) ? $cliente->email : ''}}">
  </div>
  <div class="input-group col">
    <div class="input-group-prepend">
      <span class="input-group-text" id="telefone"><i class="material-icons">phone</i></span>
    </div>
    <input id="telefone" name="telefonenumero" class="form-control input-md" placeholder="(XX) X XXXX-XXXX" onkeypress="return isNumberKey(event)" required="" type="text" maxlength="11" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
    OnKeyPress="formatar('## #####-####', this)" value="{{isset($cliente->telefonenumero) ? $cliente->telefonenumero : ''}}">
  </div>
</div>
