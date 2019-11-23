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
                    <label for="id"><span><i class="material-icons" style="vertical-align:middle;">assignment_turned_in</i></span>&nbsp&nbsp<b>Pedido Número:</b><br><br>{{$pedido->first()->id}}</label>
                    
                </div>
                <div class="col-md-6">
                    <label for="preco"><i class="material-icons" style="vertical-align:middle;">attach_money</i>&nbsp&nbsp<b>Preço Uni</b><br><br>R${{$pedido->first()->quantidade * $pedido->first()->precoVenda}}</label>
                </div>

                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="nome"><span><i class="material-icons" style="vertical-align:middle;">assignment_turned_in</i></span>&nbsp&nbsp<b>Produtos</b><br><br>{{$pedido->first()->produto_id}}</label>
                    
                </div>
                <div class="col-md-6">
                    <label for=""><i class="material-icons" style="vertical-align:middle;">attach_money</i>&nbsp&nbsp<b>Quantidade</b><br><br>{{$pedido->first()->quantidade}} - Itens</label>
                </div>

                
            </div>
            <div class="row">
                <div class="col-md-6"> 
                <label for=""><i class="material-icons" style="vertical-align:middle;">attach_money</i>&nbsp&nbsp<b>Preço Unitário</b><br><br>R${{$pedido->first()->precoVenda}}</label>
                   
                </div>
                <div class="col-md-6">
                </div>

                
            </div>

            
            
         

        </div>
    </div>
    
    </div>
    
</div>













@endsection