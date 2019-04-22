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
      <span class="input-group-text" id="cliente"><i class="material-icons">money</i></span>
    </div>
    <input class="form-control" name="valor" type="text" placeholder="Valor" value="{{isset($peca->valor) ? $peca->valor : ''}}">
  </div>

</div>
