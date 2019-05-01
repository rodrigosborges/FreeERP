<div class="form-group">
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" id="cliente"><i class="material-icons">person</i></span>
    </div>
    <input class="form-control" name="nome" type="text" placeholder="Nome da peça" value="{{isset($peca->nome) ? $peca->nome : ''}}">
  </div>

</div>
<div class="form-group">
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" id="cliente"><i class="material-icons">money_off</i></span>
    </div>
    <input class="form-control" name="valor_compra" type="text" placeholder="Valor de compra" value="{{isset($peca->valor_compra) ? $peca->valor_compra : ''}}">
  </div>

</div>
<div class="form-group">
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" id="cliente"><i class="material-icons">money</i></span>
    </div>
    <input class="form-control" name="valor_venda" type="text" placeholder="Valor para venda" value="{{isset($peca->valor_venda) ? $peca->valor_venda : ''}}">
  </div>

</div>
