@extends('estoquemadeireira::estoque.template')

@section('title', 'Cadastro de Estoque')

@section('body')


<form action="{{url($data['url'])}}" method="POST" class="estoqueForm">
    @csrf
    @if(isset($data['estoque']))
    @method('put')
    @endif
    <p class="feedback-errors alert"></p>
    <div class="row">

        <div class="col-lg-6  col-md-6 col-sm-6">
            <div class="form-group">
                <label for="categoria_id">Produto</label>
                @if($data['estoque'])
                <input type="text" disabled="disabled" class="form-control" value ="{{$data['estoque']->produtos->last()->nome}}">
                @else
                <select class="custom-select produto_id" id="produto_id" name="produto_id">
                    <option value="-1">Selecione</option>
                    @foreach($data['produtos'] as $produto)
                    <option value="{{$produto->id}}" {{isset($data['estoque']) && $data['produto']->id==$produto->id?'selected':''}}>{{$produto->nome}}</option>
                    @endforeach
                </select>
                @endif
            </div>
        </div>

        <div class="col-lg-6  col-md-6 col-sm-6">
            <div class="form-group">
                <label for="tipoUnidade_id">Nome da Unidade</label>
                <select class="custom-select tipoUnidade_id" id="tipoUnidade_id" name="tipoUnidade_id">
                    <option value="-1">Selecione a Unidade</option>
                    @foreach($data['tipoUnidade'] as $unidade)
                    <option value="{{$unidade->id}}"  {{isset($data['estoque']) && $data['estoque']->tipo_unidade_id==$unidade->id?'selected':''}}>{{$unidade->nome}}  </option>
                    @endforeach

                </select>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="form-group">
                <label for="preco_custo">Preço de Custo</label>
                <input type="text" name="preco_custo" id="preco_custo" value=" {{isset($data['estoque'])?$data['estoque']->movimentacaoEstoque->last()->preco_custo:''}}" placeholder="R$" onkeyUp="moeda(this);" class="form-control preco_custo" required>
            </div>
        </div>

        <div class="form-group col-lg-4 col-md-4 col-sm-4">
            <label for="nome">Quantidade</label>
            <input type="{{isset($data['estoque'])?'text':'number'}}" placeholder="Insira a quantidade" name='quantidade' required id="quantidade" class="form-control quantidade" maxlength="45" value=" {{isset($data['estoque'])?(int)$data['estoque']->quantidade:''}}">
            <p class=" alert" id="mensagem-nome"> {{$errors->first('quantidade')}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-right">
        <button type="submit" class="btn btn-primary">{{$data['button']}}</button>
        </div>
    </div>

</form>
@endsection
@section('js')


<script>
    function moeda(i) {
        var v = i.value.replace(/\D/g, '');
        v = (v / 100).toFixed(2) + '';
        v = v.replace(",", ".");
        v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1$2$3.");
        v = v.replace(/(\d)(\d{3}),/g, "$1$2.");
        i.value = v;
    }
</script>
@endsection