@extends('estoque::template')
@section('title', 'Ficha do Produto')
@section('content')

<link rel="stylesheet" type="text/css" href="../../Resources/assets/css/style.css">


<div class="container" style="justify-content: center">
    <div class="card">
        <div class="card-header">
            Ficha do Produto
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <label for="nome"><i class="material-icons">account_circle</i>Nome: {{$produto->nome}}</label>
                    
                </div>
                <div class="col-md-6">
                    <label for="preco"><i class="material-icons">attach_money</i>Preço: {{$produto->preco}}</label>
                </div>

                
            </div>
            <hr>
            
            <div class="row">

                <div class="col-md-6">
                    <label for="codigo"><b>llll</b>Código de Barras: {{$produto->codigo}}</label>
                </div>

                <div class="col-md-6">
                    <label for="categoria"><i class="material-icons">category</i>Categoria: {{$produto->categoria->nome}}</label>   
                </div>       
            </div>

            <hr>
            
            <div class="row">
                <div class="col-md-12">
                    <label for="descricao"><i class="material-icons icon" style="margin: 5px">event_note</i>Descrição: {{$produto->descricao}}</label> 
                </div>
            </div>
            
            
         

        </div>
    </div>
    <div class="d-flex justify-content-end mt-3">
    <form method="POST" action="{{url('/estoque/produto/' . $produto->id)}}">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger">Desativar</button>
    </form>
    </div>
</div>
@endsection

