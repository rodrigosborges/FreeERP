
<div class="form-group row">

  <div class="form-group col-lg-4 col-sm-12">
    <input class="form-control form-control-plaintext" name="numeroOrdem" type="text" value="{{ $id }}" readonly>
  </div>

  <div class="form-group col-lg-4 col-sm-12">
    <div class="input-group-prepend">
      <span class="input-group-text" id="nascimento"><i class="material-icons">calendar_today</i></span>
      <input class="form-control" name="data_entrada" id="teste" type="text" value="{{ date('d/m/Y') }}" readonly>
    </div>
  </div>

  <div class="form-group col-lg-4  col-sm-12">
    <div class="input-group-prepend">
      <span class="input-group-text" id="nascimento"><i class="material-icons">attach_money</i></span>
      <input class="form-control" name="valor" id="valorTotal" type="text" value="" readonly>
    </div>
  </div>

</div>


<div class="form-group row">
  <div class="input-group col">
      <select class="custom-select " id="situacao" name="situacao">
        <option selected value="Aguardando autorização do orçamento">Aguardando autorização do orçamento</option>
        <option value="Autorizado">Autorizado</option>
        <option value="Em reparo">Em reparo</option>
        <option value="Aguardando retirada do cliente">Aguardando retirada do cliente</option>
      </select>
   </div>

</div>
<div>
  @include('assistencia::paginas.consertos._navOS')
</div>
