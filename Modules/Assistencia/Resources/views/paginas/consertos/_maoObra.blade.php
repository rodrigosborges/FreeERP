<div class="row form-group">
  <div class="col-12 ">
  <label for="">Selecione a mão de obra</label>
    <select style="width:100%;" name="servicos[]" id="valor_servico" class="form-control multi-select"  multiple="true">
      @foreach($servicos as $servico) <!-- aqui o retorno é o id da peça -->
            <option value="{{$servico->id}}">{{ $servico->nome }} |  {{ $servico->valor }}</option>
      @endforeach 
    </select>
  </div>
</div>

<!--
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
    <input required class="form-control" name="nome_servico" type="text" placeholder="" value="{{ isset($conserto->servico->nome) ? $conserto->servico->nome : old('nome', '') }}">
    ISSET NAO TA FUNFANDO NO EDITAR
  </div>
  <div class="col">
    <input class="form-control" name="valor_servico" type="text" placeholder="" value="{{ isset($conserto->servico->valor) ? $conserto->servico->valor : old('valor', '') }}">
  </div>
</div>
form
-->