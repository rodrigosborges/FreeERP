<div class="row form-group">
  <div class="col-12 ">
  <label for="">Selecione a mão de obra</label>
    <select style="width:100%;" name="servicos[]" id="valor_servico" class="form-control multi-select"  multiple="true">
      @foreach($servicos as $servico) <!-- aqui o retorno é o id da peça -->
            <option data-valor="{{ $servico->valor }}" value="{{$servico->id}}">{{ $servico->nome }} |  {{ $servico->valor }}</option>
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
<<<<<<< HEAD
-->


array(22) { ["_token"]=> string(40) "cjzuRgHokaizmhk6mgxd1Bd6Y7SbZrk7bJrZbCFO" 
  ["numeroOrdem"]=> NULL 
  ["data_entrada"]=> string(2) "50" 
  ["situacao"]=> string(10) "Autorizado" 
  ["idCliente"]=> string(1) "1" 
  ["selecionarCliente"]=> string(27) "Rafael Alves|123.456.789/77" 
  ["nome"]=> string(12) "Rafael Alves" 
  ["cpf"]=> string(14) "123.456.789/77" 
  ["email"]=> string(25) "alvesrafael17@hotmail.com" 
  ["celnumero"]=> string(14) "(12) 1212-1212" 
  ["modelo_aparelho"]=> string(4) "asas" 
  ["marca_aparelho"]=> string(7) "fasfasf" 
  ["serial_aparelho"]=> string(9) "asfasfasf" 
  ["imei_aparelho"]=> string(4) "asfa" 
  ["defeito"]=> string(3) "asf" 
  ["obs"]=> string(5) "sfasf" 
  ["pecas"]=> array(2) { [0]=> string(1) "1" [1]=> string(1) "2" } 
  ["servicos"]=> array(1) { [0]=> string(1) "1" } 
  ["selecionarTecnico"]=> string(22) "tecnico|454.545.454/54" 
  ["idTecnico"]=> string(1) "1" 
  ["nome-tecnico"]=> string(7) "tecnico" 
  ["cpf-tecnico"]=> string(14) "454.545.454/54" 
}
