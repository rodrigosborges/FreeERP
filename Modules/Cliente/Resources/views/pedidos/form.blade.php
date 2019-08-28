@extends('cliente::template')
@section('title')
Nova Compra - {{ $cliente->nome }}
@endsection
@section('body')

<div class="container border" STYLE="BACKGROUND: RED">

    <div class="col-12 border" style="background:yellow;">

    <form action="" class="p-1" style="background:pink">

        <div class="form-group form-row pl-1">
            <div class="col-4">
            <label for="data-pedido" style="font-weight: bolder;">Data do pedido</label>
                <input type="date" name="data-pedido" id="data-pedido" class="form-control" placeholder="Data da Compra">
            </div>
        </div>
        <div class="form-group form-row pl-1">
            <div class="col-2">
                <input type="number" class="form-control" name="codigo" id="codigo" placeholder="Código">
                <small id="passwordHelpBlock" class="form-text text-muted">Código Item</small>
            </div>
            <div class="col-5   ">
                <input type="text" class="form-control" name="produto" id="produto" placeholder="Produto">
            </div>  
        </div>
        

        </div>




    </form>
</div>




</div>

@endsection