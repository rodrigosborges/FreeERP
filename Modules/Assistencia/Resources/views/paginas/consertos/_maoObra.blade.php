
<div class="form-group row">
  <div class="input-group col">
    <div class="input-group-prepend">
      <span class="input-group-text" id="nome"><i class="material-icons">link_off</i></span>
    </div>
    <input class="form-control" name="selecionarMao" type="text" placeholder="Escolha a mão-de-obra">
  </div>
</div>


<div class="form-group row">
  <input type="hidden" name="idMaoObra" value="{{isset($conserto->idMaoObra) ? $conserto->idMaoObra : ''  }}">
  <div class="col">
    <input class="form-control" name="nome_servico" type="text" placeholder="" value="{{ isset($conserto->servico->nome) ? $conserto->servico->nome : old('nome', '') }}">
    ISSET NAO TA FUNFANDO NO EDITAR
  </div>
  <div class="col">
    <input class="form-control" name="valor_servico" type="text" placeholder="" value="{{ isset($conserto->servico->valor) ? $conserto->servico->valor : old('valor', '') }}">
  </div>
</div>
form
