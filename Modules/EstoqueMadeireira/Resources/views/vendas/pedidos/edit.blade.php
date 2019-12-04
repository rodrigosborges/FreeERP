@extends('estoquemadeireira::vendas.vendastemplate')

@section('title','Pedidos')

@section('body')



<div class="container col-12" style="justify-content: center">
    <div class="card">
            <div class="card-header" style="">
                <h3>Atualizar pedido: Nº {{$pedido->first()->pedido_id}}</h3> 
                <h3>Cliente: {{$cliente->first()->nome}}</h3>
            </div>
            <form action="{{isset($pedido) ?  url('/estoquemadeireira/vendas/pedidos/' . $pedido->first()->id) : url('/estoquemadeireira/vendas/pedidos')}}" method="POST">
            @csrf
            @if(isset($pedido))
                @method('put')
            @endif
            <div class="row ml-4 mt-2">
            <h4>Produtos: {{$produtos->last()->nome}} | {{$pedido->first()->quantidade}} - Itens</h4>
            </div>
            <div class="row ml-2 mt-2">
                <div class="form-group col-3">
                    <label for="status_pedido">Status</label>
                    <select class="form-control" name="status_pedido"  id="status_pedido">
                    <option value="1">Aberto</option>
                    <option value="2">Enviado</option>
                    <option value="3">Finalizado</option>
                    </select>
                </div>       
                <div class="form-group col-3">
                    <label for="desconto">Desconto</label>
                    <input class="form-control" type="text" id="desconto" name="desconto" onKeyUp="verificaPreco(this);">
                </div>

                <div class="row col-12 mb-2" style="justify-content: flex-end;">
                    <button type="submit" class="btn btn-primary">{{isset($pedido) ? 'Salvar' : 'Cadastrar' }}</button>
                </div>
            </div>

    </form>
</div>
     
</div>       

@endsection
<script>
    function verificaPreco(i){
        var v = i.value.replace(/\D/g,'');
        v = (v/100).toFixed(2) + '';
        v = v.replace(",", ".");
        v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1$2$3.");
        v = v.replace(/(\d)(\d{3}),/g, "$1$2.");
        i.value = v;
    
    }
</script>

