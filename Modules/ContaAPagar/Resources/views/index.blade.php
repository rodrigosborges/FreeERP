@extends('contaapagar::layouts.master')

@section('css')
    <style>
        .teste {
            display: flex;
            justify-content: flex-end;
            margin-right: 1px;
        }
        
        #novo {
            margin-right: 2.5px;
        }
        
        #dropdownMenuButton{
            margin-left: 2.5px;
        }
        
        .check {
            display: flex;
            justify-content: flex-end;
            margin-right: 1px;
        }
        
    </style>
@stop
@section('content')
    <h1>Despesa total no período</h1>
    
<header>        
    <div class="row" style="padding-left: 15px;">
        <div class="card col-sm-2 d-flex align-items-center align-content-center"><h3>R${{$total}}</h3></div>
    </div>
    <div class="row teste">
        <button type="button" class="btn btn-primary" id="novo">+Novo</button>
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categoria
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{Route('contaapagar')}}">Todas categorias</a>
              @foreach ($categorias as $categoria)
                <a class="dropdown-item" href="{{Route('cat.id', $categoria->id)}}">{{ $categoria->nome }}</a>
              @endforeach
          </div>
        </div>
    </div>
</header>    
<br>
        
  
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Descrição</th>
                <th scope="col">Data de Vencimento</th>
                <th scope="col">Data de Pagamento</th>
                <th scope="col">Valor</th>
                <th scope="col">Status</th>
                <th scope="col">Detalhes</th>

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

<section class="row check">
    <a class="btn btn-primary" href="{{ route('check.status') }}">Teste</a>

</section>
    
@stop