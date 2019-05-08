
<div class="form-group row">
  <div class="input-group col">
    <div class="input-group-prepend">
      <span class="input-group-text" id="nome"><i class="material-icons">link_off</i></span>
    </div>
    <input class="form-control" name="selecionarPeca" type="text" placeholder="Escolha a peça">
  </div>
</div>


<div class="form-group row">
  <input type="hidden" name="idPeca" value="{{isset($conserto->idPeca) ? $conserto->idPeca : ''}}">
  <div class="col">
    <input class="form-control" name="nome_peca" type="text" placeholder="" value="">
  </div>
  <div class="col">
    <input class="form-control" name="valor_peca" type="text" placeholder="" value="">
  </div>
</div>
