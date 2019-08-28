@extends('cliente::template')
@section('title')
Nova Compra - {{ $cliente->nome }}
@endsection
@section('body')

<div class="container border">

    {{-- <div class="col-12 border"> --}}

    <form action="" class="">

        <div class="form-group">
            <div class="col-3">
            <label for="data-pedido">Data do pedido</label>
                <input type="date" name="data-pedido" id="data-pedido" class="form-control" placeholder="Data da Compra" required>
            </div>
        </div>

        <div class="input-group">
            <div class="input-group-prepend col-2">
                <span class="input-group-text purple lighten-3" id="basic-text1">
                    <i class="material-icons" aria-hidden="true">search</i></span>
            
                <input type="search" class="form-control" name="codigo" id="codigo" placeholder="Código">
            </div>
            <div class="col-4 ">
                    <input type="text" class="form-control" name="produto" id="produto" placeholder={{"Produto"}}>
            </div>
            <div class="col col-2">
                <input type="number" min="1" class="form-control" name="qtde" id="qtde" placeholder="Qtde">
            </div>
            <div class="col col-2">
                    <input type="number" min="0" class="form-control" name="desconto" id="desconto"  
                                aria-label="0,0%" aria-describedby="basic-addon2">
                    <div class="input-group-append col-1">
                            <span class="input-group-text" id="basic-addon2">%</span>
                    </div>
            </div>
            <div class="col-2 ">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Adicionar</button>
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