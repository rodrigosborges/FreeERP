

<div class="form-group row">
  <div class="input-group col">
    <div class="input-group-prepend">
      <span class="input-group-text" id="nome"><i class="material-icons">link_off</i></span>
    </div>
    <input class="form-control" name="selecionarTecnico" type="text" placeholder="Tecnico responsavel">
  </div>
</div>

<div class="form-group row">
	<input type="hidden" name="idTecnico" value="{{isset($conserto->idCliente) ? $conserto->idCliente : ''}}">
  <div class="input-group col">
    <div class="input-group-prepend">
      <span class="input-group-text" id="nome"><i class="material-icons">person</i></span>
    </div>
    <input class="form-control" name="nome-tecnico" type="text" placeholder="Nome completo" value="{{ isset($cliente->nome) ? $cliente->nome : old('nome', '') }}" readonly="">
  </div>
  <div class="input-group col">
    <div class="input-group-prepend">
      <span class="input-group-text" id="cpf"><i class="material-icons">account_box</i></span>
    </div>
    <input type="text" class="form-control cpf-mask" name="cpf-tecnico" placeholder="000.000.000-00" readonly value="{{ isset($cliente->cpf) ? $cliente->cpf : old('cpf', '') }}">
  </div>
</div>




