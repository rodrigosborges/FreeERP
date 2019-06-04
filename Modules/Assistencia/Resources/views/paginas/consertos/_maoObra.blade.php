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


array(22) { ["_token"]=> string(40) "cjzuRgHokaizmhk6mgxd1Bd6Y7SbZrk7bJrZbCFO"
  ["numeroOrdem"]=> NULL



  //["selecionarCliente"]=> string(27) "Rafael Alves|123.456.789/77"
  //["nome"]=> string(12) "Rafael Alves"
  //["cpf"]=> string(14) "123.456.789/77"
  //["email"]=> string(25) "alvesrafael17@hotmail.com"
  //["celnumero"]=> string(14) "(12) 1212-1212"






  ["pecas"]=> array(2) { [0]=> string(1) "1" [1]=> string(1) "2" }
  ["servicos"]=> array(1) { [0]=> string(1) "1" }

  //["selecionarTecnico"]=> string(22) "tecnico|454.545.454/54"

  //["nome-tecnico"]=> string(7) "tecnico"
  //["cpf-tecnico"]=> string(14) "454.545.454/54"
}

["numeroOrdem"]=> NULL
valor
["situacao"]=> string(10) "Autorizado"
["data_entrada"]=> string(2) "50"
["modelo_aparelho"]=> string(4) "asas"
["marca_aparelho"]=> string(7) "fasfasf"
["serial_aparelho"]=> string(9) "asfasfasf"
["imei_aparelho"]=> string(4) "asfa"
["defeito"]=> string(3) "asf"
["obs"]=> string(5) "sfasf"
["idCliente"]=> string(1) "1"
["idTecnico"]=> string(1) "1"
