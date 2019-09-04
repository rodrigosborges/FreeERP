@extends('estoque::template')
@section('title', 'Ficha do Produto')

@section('content')



<div class="container" style="justify-content: center">
    <div class="card">
        <div class="card-header">
            Ficha do Produto
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">
                    <label for="nome">Nome</label>
                    <input placeholder="{{$produto->nome}}" name="nome" class="form-control" disabled="disabled">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <label for="preco">Preço</label>
                    <input placeholder="{{$produto->preco}}" name="preco" class="form-control" disabled="disabled">
                </div>
           
            
                <div class="col-md-4">
                    <label for="codigo">Código de Barras</label>
                    <input placeholder="{{$produto->codigo}}" name="codigo" class="form-control" disabled="disabled">
                </div>

                <div class="col-md-4">
                    <label for="categoria">Categoria</label>
                    <input placeholder="{{$produto->categoria->nome}}" name="{{$produto->categoria_id}}" class="form-control" disabled="disabled">
                    
            
                </div>

                <div class="col-md-12">
                    <label for="descricao">Descrição</label>
                    <textarea placeholder="{{$produto->descricao}}" name="descricao" class="form-control" disabled="disabled"></textarea>
                </div>
            </div>

            
         

        </div>
    </div>
</div>
@endsection

