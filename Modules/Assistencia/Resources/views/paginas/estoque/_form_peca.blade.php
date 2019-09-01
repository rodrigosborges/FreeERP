<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="cliente"><i class="material-icons">person</i></span>
        </div>
        <input class="form-control" name="nome" type="text" placeholder="Nome da peça"
            value="{{isset($peca->nome) ? $peca->nome : old('nome', '')}}">

        <div class="col-12">
            <span class="errors"> {{ $errors->first('nome') }} </span>
        </div>
    </div>

</div>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="cliente"><i class="material-icons">money_off</i></span>
        </div>
        <input class="form-control" name="valor_compra" type="text" id="money1" placeholder="Valor da compra"
            value="{{isset($peca->valor_compra) ? $peca->valor_compra : old('valor_compra', '')}}">
        <div class="col-12">
            <span class="errors"> {{ $errors->first('valor_compra') }} </span>
        </div>
    </div>

</div>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="cliente"><i class="material-icons">attach_money</i></span>
        </div>
        <input class="form-control" name="valor_venda" type="text" id="money2" placeholder="Valor para venda"
            value="{{isset($peca->valor_venda) ? $peca->valor_venda : old('valor_venda', '')}}">
        <div class="col-12">
            <span class="errors"> {{ $errors->first('valor_venda') }} </span>
        </div>
    </div>

</div>
<div class="form-group col-12">
    <input class="form-control" id="qnt" name="quantidade" type="text" maxlength="2" placeholder="Quantidade"
        value="{{isset($peca->quantidade) ? $peca->quantidade : old('quantidade', '')}}">
</div>