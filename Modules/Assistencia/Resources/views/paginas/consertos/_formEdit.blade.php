<div class="form-group row">

    <div class="form-group col-lg-4 col-sm-12">
        <input class="form-control form-control-plaintext" name="numeroOrdem" type="text" value="{{ $id }}" readonly>
    </div>

    <div class="form-group col-lg-4 col-sm-12">
        <div class="input-group-prepend">
            <span class="input-group-text" id="nascimento"><i class="material-icons">calendar_today</i></span>
            <input class="form-control" name="data_entrada" type="text" value="{{ date('d/m/Y') }}" readonly>
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
        <option {{isset($conserto) ? (($conserto->situacao == "Aguardando autorização do orçamento") ? 'selected': '') : ''}} value="Aguardando autorização do orçamento">Aguardando autorização do orçamento</option>
            <option value="Autorizado" {{isset($conserto) ? (($conserto->situacao == "Autorizado") ? 'selected': '') : ''}}>Autorizado</option>
            <option value="Em reparo" {{isset($conserto) ? (($conserto->situacao == "Em reparo") ? 'selected': '') : ''}}>Em reparo</option>
            <option value="Aguardando retirada do cliente" {{isset($conserto) ? (($conserto->situacao == "Aguardando retirada do cliente") ? 'selected': '') : ''}}>Aguardando retirada do cliente</option>
        </select>
    </div>

</div>
<div class="form-group">
    <input type="textarea" class="form-control" placeholder="Informações adicionais - Ex.: Cliente foi informado por ligação (Opcional)" name="obsInfo">
</div>
<div>
    @include('assistencia::paginas.consertos._navOSedit')
</div>