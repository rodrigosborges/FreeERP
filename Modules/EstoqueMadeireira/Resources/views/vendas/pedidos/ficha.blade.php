@extends('estoquemadeireira::vendas.vendastemplate')

@section('title', 'Pedidos')

@section('body')

<div class="container col-12" style="justify-content: center" id="imprimir">
    <div class="card">
        <div class="card-header">
            Ficha do Pedido
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <label for="id"><span><i class="material-icons" style="vertical-align:middle;">assignment_turned_in</i></span>&nbsp&nbsp<b>Pedido</b><br><br>Nº: {{$pedido->first()->pedido_id}}</label>
                    
                </div>
                <div class="col-md-6">
                    <label for="preco"><i class="material-icons" style="vertical-align:middle;">attach_money</i>&nbsp&nbsp<b>Preço de Venda Total</b><br><br>R${{number_format(($pedido->first()->quantidade * $pedido->first()->precoVenda - $pedido->first()->desconto), 2, '.', '')}}</label>
                </div>

                
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="    nome"><span><i class="material-icons" style="vertical-align:middle;">insert_chart</i></span>&nbsp&nbsp<b>Produtos</b><br><br>{{$produtos->last()->nome}} | {{$pedido->first()->quantidade}} - Itens</label>
                    
                </div>
                <div class="col-md-6">
                <label for=""><i class="material-icons" style="vertical-align:middle;">attach_money</i>&nbsp&nbsp<b>Preço Unitário</b><br><br>R${{$pedido->first()->precoVenda}}</label>
                </div>

                
            </div>
            <div class="row mt-2">
                <div class="col-md-6"> 
                <label for=""><i class="material-icons" style="vertical-align:middle;">person</i>&nbsp&nbsp<b>Cliente</b><br><br>{{$cliente->first()->nome}} <br> {{$cliente->first()->email}}   <br> <br> Endereço: {{$endereco->first()->endereco}} - {{$endereco->first()->complemento}} </label>

                </div>
                
                
                <div class="col-md-6">
                <label for=""><i class="material-icons" style="vertical-align:middle;">attach_money</i>&nbsp&nbsp<b>Lucro de Venda</b><br><br>R$ {{number_format(($pedido->first()->quantidade * $produtos->first()->preco) - $pedido->first()->quantidade * $produtos->first()->precoCusto - $pedido->first()->desconto, 2, '.','')}}  </label> <br>
                @if($pedido->first()->desconto != 0)
                <label for=""><i class="material-icons" style="vertical-align:middle;">attach_money</i>&nbsp&nbsp<b>Desconto</b><br><br>R$ {{$pedido->first()->desconto}} </label>
                @endif
                </div>

                
            </div>

            
            
         

        </div>
    </div>
    
    </div>
    













@endsection