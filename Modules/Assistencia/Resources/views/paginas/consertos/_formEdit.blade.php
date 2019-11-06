<div class="form-group row">

    <div class="form-group col-lg-3 col-sm-12">
        <label for="numeroOrdem">Numero da OS:</label>
        <input class="form-control form-control-plaintext" name="numeroOrdem" type="text" value="{{ $conserto->numeroOrdem }}" readonly>
    </div>

    <div class="form-group col-lg-3 col-sm-12">
        <label for="data_entrada">Data:</label>
        <div class="input-group-prepend">
            <input class="form-control" name="data_entrada" type="text" value="{{ date('d/m/Y') }}" readonly>
        </div>
    </div>

    <div class="form-group col-lg-3  col-sm-12">
        <label for="valor">Valor do serviço:</label>
        <div class="input-group-prepend">
            <input class="form-control" name="valor" id="valorTotal" type="text" value="" readonly>
        </div>
    </div>
    <div class="form-group col-lg-3 col-sm-12">
        <label for="sinal">Adiantamento:</label>
        <div class="input-group-prepend">
            <input type="text" class="form-control" name="sinal" value="{{isset($conserto->sinal) ? $conserto->sinal : old('sinal', '')}}">
        </div>
    </div>

    <div class="form-group col-12">
    <label for="sinal">Status da OS:</label>
        <div class="input-group col-12">
            <select class="custom-select " id="situacao" name="situacao">
            <option {{isset($conserto) ? (($conserto->situacao == "Aguardando autorização do orçamento") ? 'selected': '') : ''}} value="Aguardando autorização do orçamento">Aguardando autorização do orçamento</option>
                <option value="Autorizado" {{isset($conserto) ? (($conserto->situacao == "Autorizado") ? 'selected': '') : ''}}>Autorizado</option>
                <option value="Em reparo" {{isset($conserto) ? (($conserto->situacao == "Em reparo") ? 'selected': '') : ''}}>Em reparo</option>
                <option value="Aguardando retirada do cliente" {{isset($conserto) ? (($conserto->situacao == "Aguardando retirada do cliente") ? 'selected': '') : ''}}>Aguardando retirada do cliente</option>
            </select>
        </div>

    </div>
</div>



<div class="form-group">
    <input type="textarea" class="form-control" placeholder="Informações adicionais - Ex.: Cliente foi informado por ligação (Opcional)" name="obsInfo">
</div>
<div>
    @include('assistencia::paginas.consertos._navOSedit')
</div>
