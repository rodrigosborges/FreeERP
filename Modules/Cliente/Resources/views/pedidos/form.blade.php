@extends('cliente::template')
@section('title')
Nova Compra - {{ $cliente->nome }}
@endsection
@section('body')

<div class="container border">

    {{-- <div class="col-12 border"> --}}

    <form action="" class="p-2">

        <div class="form-group form-row pl-1">
            <div class="col-3 pl-3">
            <label for="data-pedido">Data do pedido</label>
                <input type="date" name="data-pedido" id="data-pedido" class="form-control" placeholder="Data da Compra">
            </div>
        </div>

        <div class="input-group pb-1">
            <div class="input-group-prepend col-form-label col-3 border">
                <span class="input-group-text purple lighten-3" id="basic-text1">
                    <i class="material-icons" aria-hidden="true">search</i></span>
            
                <input type="search" class="form-control" name="codigo" id="codigo" placeholder="Código">
            </div>
            <div class="col-5 col-form-label border">
                    <input type="text" class="form-control" name="produto" id="produto" placeholder="Produto">
            </div>
            <div class="col-form-label col-2 border">
                <input type="number" class="form-control" name="qtde" id="qtde" placeholder="Qtde">
            </div>
            <div class="col-2 col-form-label border d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" style="width: 90%;">Adicionar</button>
            </div>

        </div>
    </form>
    <hr />
    <div id="itens_adicionados" class="border" style="min-width: 30%; width: 40%;"> 
        <h1>Teste</h1>
    
    
    </div>
{{-- </div> --}}




</div>

@endsection