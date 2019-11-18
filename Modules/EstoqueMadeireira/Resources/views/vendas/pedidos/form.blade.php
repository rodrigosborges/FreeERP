@extends('estoquemadeireira::vendas.vendastemplate')

@section('title', 'Pedidos')

@section('body')

<div class="container" style="justify-content: center;" id=""> 
    <div class="card">
        <div class="card-header">
            <h4>Registro de Pedido</h4>
        </div>
        <div class="row col-4 ml-2 mb-2">
            <label for="Cliente">Cliente</label>
            <input class="form-control" type="text" id="nomeCliente">           
        </div>
    </div>
</div>












@endsection
@yield('js')