@extends('estoquemadeireira::vendas.vendastemplate')

@section('title', 'Pedidos')

@section('body')

<div class="container">
<div class="card col-md-12">
        <div class="card-body"> 
            <div class="header text-left">
                <h4>Pesquisar Pedido</h4>
            </div>
            <form action="{{url('estoquemadeireira/vendas/pedidos/busca')}}" method="POST" id="form">
            @csrf
            <div class="row">
                    <div class="form-group col-8">
                        <input type="text" id="search-input" maxlength="40" placeholder="Insira o ID do pedido" class="form-control" name="pesquisa">
                    </div>   
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-secondary" style="font-size:18px;"><i class="btn btn-sm btn-secondary material-icons" style="font-size:18px;" id="search-button">search</i></button>
                    </div>             
                </div>
                

            </form>
            
        
        </div>
    
    
    </div>
    <div class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a href="#ativos" class="nav-link active" role="tab" data-toggle="tab"> 
                <h5>Pedidos</h5>
            </a>       
        </li>   
    </div>

    <div class="tab-content">
        <div class="tab-pane active" role="tabpane11" id="ativos">
            <table class="table text-center">
                <thead class="card-header">
                    <div class="col-12 text-right">
                            <a href="{{url('/estoquemadeireira/vendas/pedidos/create')}}" class="btn btn-success btn-sm mt-2 mb-3">
                                <i class="material-icons" style="vertical-align:middle; font-size:25px;">note_add</i>Adicionar 
                            </a>
                    </div>

                    <tr>
                        <th scope="col">ID</th>                       
                        <th scope="col">Cliente</th> 
                        <th scope="col">Valor Total</th>
                        <th scope="col">Visualizar</th>  
                        <th scope="col">Editar</th>            
                        <th scope="col">Status</th>
                        </thead>

                    <tbody>
                        @if(isset($pedidos))
                        @foreach($pedidos as $pedido)
                            <tr>
                                <td>{{$pedido->id}}</td>
                                <td>{{$pedido->nome}}</td>
                                <td>R$ {{$pedido->precoVenda * $pedido->quantidade - $pedido->desconto}}</td>
                                <td>
                                <a href="{{url('/estoquemadeireira/vendas/pedidos/ficha/' . $pedido->id)}}"><button class="btn btn-sm" style="font-size: 0px; background-color:blue;">
                                    <i class="material-icons" style="font-size:18px;">remove_red_eye</i></button></a>
                                </td>
                                <td>
                                <a href="{{url('/estoquemadeireira/vendas/pedidos/' . $pedido->id . '/edit')}}"><button class="btn btn-sm btn-warning"><i class="material-icons" style="font-size:18px;">border_color</i></button></a>
                                </td>                          
                                @if($pedido->status_pedido == 1)
                                <td><button type="button" class="btn btn-success btn-sm">Aberto</button></td>                        
                                @endif                          
                                @if($pedido->status_pedido == 2)   
                                <td><button type="button" class="btn btn-warning btn-sm">Enviado</button></td>                    
                                @endif                          
                                @if($pedido->status_pedido == 3)   
                                <td><button type="button" class="btn btn-primary btn-sm">Finalizado</button></td>
                                @endif                          
                            </tr>                      
                        @endforeach
                        @endif          
                    
                    </tbody>             
                    <tfoot>
                            <tr>
                                <td colspan="100%" class="text-center">
                                    <p class="text-cetner">
                                        Página {{$pedidos->currentPage()}} de {{$pedidos->lastPage()}}
                                        -Exibido {{$pedidos->perPage()}} registro(s) por página de {{$pedidos->total()}}
                                    </p>
                                </td>
                            </tr>
                            @if($pedidos->lastPage() > 1)
                            <tr>
                                <td colspan="100%" class="text-center">
                                    {{ $pedidos->links() }}
                                </td>
                            </tr>
                            @endif
                    </tfoot>
                </thead>
            </table>       
        </div>   
    </div>  
</div>
@stop