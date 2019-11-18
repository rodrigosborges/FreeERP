@extends('estoquemadeireira::vendas.vendastemplate')

@section('title', 'Vendas')

@section('body')

<div class="container">
<div class="card col-md-12">
        <div class="card-body"> 
            <div class="header text-left">
                <h4>Pesquisar Cliente</h4>
            </div>
            <form action="{{url('estoquemadeireira/vendas/busca')}}" method="POST" id="form">
            @csrf
            <div class="row">
                    <div class="form-group col-8">
                        <input type="text" id="search-input" maxlength="40" placeholder="Insira o nome do Cliente" class="form-control" name="pesquisa">
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
            <a href="#clientes" class="nav-link active" role="tab" data-toggle="tab"> 
                <h5>Clientes</h5>

            </a>       
        </li>   
    </div>

    <div class="tab-content">
        <div class="tab-pane active" role="tabpane11" id="ativos">
            <table class="table text-center">
                <thead class="card-header">
                    <div class="col-12 text-right">
                        <a href="{{url('/estoquemadeireira/vendas/clientes/create')}}" class="btn btn-success btn-sm mt-2 mb-3">
                            <i class="material-icons" style="vertical-align:middle; font-size:25px;">note_add</i>Adicionar 
                        </a>
                           
                    </div>

                    <tr>
                        <th scope="col">Nome</th>                       
                        @if($flag == 0)      
                        <th scope="col">Documento</th>              
                        <th scope="col">Email</th> 
                        <th scope="col">Visualizar Cliente</th>              
                        @else
                        <th scope="col">Restaurar</th>
                        @endif
  
                        </thead>    

                    <tbody>
                        @if(isset($clientes))
                        @foreach($clientes as $cliente)
                            <tr>
                                <td>{{$cliente->nome}}</td>
                                @if($flag == 0)
                                    <td>{{$cliente->documento}}</td>
                                    <td>{{$cliente->email}}</td>                           
                                    <td>
                                    <a href="{{url('/estoquemadeireira/vendas/clientes/ficha/' . $cliente->id)}}"><button class="btn btn-sm" style="font-size: 0px; background-color:blue;">
                                <i class="material-icons" style="font-size:18px;">remove_red_eye</i></button></a>
                                    </td>
                                @else
                                    <td>
                                        <form method="POST" action="{{url('/estoquemadeireira/vendas/clientes/' . $cliente->id. '/restore')}}">
                                        @method('put')
                                        @csrf
                                        <button type="submit" style="font-size:0px" class="btn btn-sm btn-info"> <i class="material-icons" style="font-size:18px;">restore_from_trash</i></button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        @endif          
                    
                    </tbody>

                    
                    <tfoot>
                            <tr>
                                <td colspan="100%" class="text-center">
                                    <p class="text-cetner">
                                        Página {{$clientes->currentPage()}} de {{$clientes->lastPage()}}
                                        -Exibido {{$clientes->perPage()}} registro(s) por página de {{$clientes->total()}}
                                    </p>
                                </td>
                            </tr>
                            @if($clientes->lastPage() > 1)
                            <tr>
                                <td colspan="100%" class="text-center">
                                    {{ $clientes->links() }}
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