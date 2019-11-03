<div class="row">

    <div class="form-group col-lg-3 col-sm-12">
        <label for="numeroOrdem">Número da OS:</label>
        <input class="form-control form-control-plaintext" name="numeroOrdem" type="text" value="20190{{ $id }}" readonly>
    </div>

    <div class="form-group col-lg-3 col-sm-12">
        <label for="data_entrada">Data:</label>
        <div class="input-group-prepend">
            <input class="form-control" name="data_entrada" type="text" value="{{ date('d/m/Y') }}" readonly>
        </div>
        <div class="col-12 form-group">
            <span class="errors"> {{ $errors->first('data_entrada') }} </span>
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
            <input type="text" class="form-control" name="sinal">
        </div>
    </div>





    <div class="form-group col-12">
        <label for="situacao">Status da OS:</label>
        <div class="input-group col-12">
            <select class="custom-select " id="situacao" name="situacao">
                <option selected value="Aguardando autorização do orçamento">Aguardando autorização do orçamento</option>
                <option value="Autorizado">Autorizado</option>
                <option value="Em reparo">Em reparo</option>
                <option value="Aguardando retirada do cliente">Aguardando retirada do cliente</option>
            </select>
        </div>
    </div>
</div>

<span class="errors"> {{ $errors->first('modelo_aparelho') }} </span>
<span class="errors"> {{ $errors->first('serial_aparelho') }} </span>
<span class="errors"> {{ $errors->first('marca_aparelho') }} </span>
<span class="errors"> {{ $errors->first('imei_aparelho') }} </span>
<span class="errors"> {{ $errors->first('defeito') }} </span>
<span class="errors"> {{ $errors->first('obs') }} </span>
<span class="errors"> {{ $errors->first('idTecnico') }} </span>


<div>
    @include('assistencia::paginas.consertos._navOS')
</div>