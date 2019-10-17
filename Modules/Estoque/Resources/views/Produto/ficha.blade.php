@extends('estoque::template')
@section('title', 'Ficha do Produto')
@section('content')

<div class="container" style="justify-content: center" id="imprimir">
    <div class="card">
        <div class="card-header">
            Ficha do Produto
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <label for="nome"><span><i class="material-icons" style="vertical-align:middle;">account_circle</i></span>&nbsp&nbsp<b>Nome</b><br><br>{{$produto->nome}}</label>
                    
                </div>
                <div class="col-md-6">
                    <label for="preco"><i class="material-icons" style="vertical-align:middle;">attach_money</i>&nbsp&nbsp<b>Preço</b><br><br>R${{$produto->preco}}</label>
                </div>

                
            </div>
            <hr>
            
            <div class="row">

                <div class="col-md-6">
                    <label for="codigo"><i class="material-icons" style="vertical-align:middle;">view_week</i>&nbsp&nbsp<b>Código de Barras</b><br><br>{{$produto->codigo}}</label>
                </div>

                <div class="col-md-6">
                    <label for="categoria"><i class="material-icons" style="vertical-align:middle;">category</i>&nbsp&nbsp<b>Categoria</b><br><br>{{$produto->categoria->nome}}</label>   
                </div>       
            </div>

            <hr>
            
            <div class="row">
                <div class="col-md-12">
                    <label for="descricao"><i class="material-icons ficha-icon" style="vertical-align:middle;">event_note</i>&nbsp&nbsp<b>Descrição</b><br><br>{{$produto->descricao}}</label> 
                </div>
            </div>
            
            
         

        </div>
    </div>
    
    <div class="d-flex justify-content-end mt-3">
    <input type="button" class="btn btn-primary mr-3" value="Imprimir" onclick="window.print()"/>
    <form method="POST" action="{{url('/estoque/produto/' . $produto->id)}}">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger ml-3">Desativar</button>
    </form>
    
    </div>
    
</div>


@endsection