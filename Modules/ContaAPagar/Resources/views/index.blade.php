@extends('contaapagar::layouts.master')


@section('content')
    <h1>Despesa Total</h1>
    
    <header>        
        <div class="row" style="padding-left: 15px;">
            <div class="card col-sm-2 d-flex align-items-center align-content-center"><h3>R$ 500,00</h3></div>
        </div>
        <div class="text-right">
            <button type="button" class="btn btn-primary" id="novo">+Novo</button>
        </div>
    </header>    
<br>
        
  
    <div class="table-responsive">
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">Descrição</th>
                <th scope="col">Data de Vencimento</th>
                <th scope="col">Data de Pagamento</th>
                <th scope="col">Valor</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($pagamentos as $pagamento)
            <tr>
                    <td>{{$pagamento->nome()}}</td>
                    <td>{{$pagamento->data_vencimento}}</td>
                    <td>{{$pagamento->data_pagamento}}</td>
                    <td>{{$pagamento->valor}}</td>
                    <td>{{$pagamento->status_pagamento}}</td>
                    <td><i class='material-icons'>search</i></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@stop

