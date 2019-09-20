@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Detalhes de movimentacao #' . $movimentacao->id)
@section('body')

<div class="container" style="justify-content: center" id="imprimir">
    <div class="card">
        <div class="card-header">
            Ficha do Produto
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                    <label for="nome"><span><i class="material-icons" style="vertical-align:middle;">account_circle</i></span>&nbsp&nbsp<b>Produto</b><br><br>{{$movimentacao->estoque->produtos->last()->nome}}</label>
                    
                </div>
                <div class="col-md-4">
                    <label for="preco"><i class="material-icons" style="vertical-align:middle;">attach_money</i>&nbsp&nbsp<b>Preço de Custo (un.)</b><br><br>R${{$movimentacao->preco_custo}}</label>
                </div>

                <div class="col-md-4">
                    <label for="codigo"><i class="material-icons" style="vertical-align:middle;">view_week</i>&nbsp&nbsp<b>Quantidade</b><br><br>{{$movimentacao->quantidade}}</label>
                </div>
                
            </div>
            <hr>
            
            <div class="row">

                <div class="col-md-4">
                    <label for="categoria"><i class="material-icons" style="vertical-align:middle;">category</i>&nbsp&nbsp<b>Data</b><br><br>{{$movimentacao->created_at}}</label>   
                </div>    
                <div class="col-md-4">
                    <label for="descricao"><i class="material-icons ficha-icon" style="vertical-align:middle;">event_note</i>&nbsp&nbsp<b>Observação</b><br><br>{{$movimentacao->observacao}}</label> 
                </div>   
            </div>
            
            
         

        </div>
    </div>
    
    <div class="d-flex justify-content-end mt-3">
    <a href="{{url('/estoque/movimentacao')}}"><button class="btn btn-primary">Voltar</button></a>
    
    </div>
    
</div>


@endsection