@extends('estoquemadeireira::layouts.master')

@section('title', 'Estoque Madeireira')

@section('content')


<div class="container">
    <div class="card col-md-12">
        <div class="card-body"> 
            <div class="header text-left mb-4">
                <h4>Estoque</h4>
            </div>
            
            <form action="{{url('/estoquemadeireira/buscar')}}" method="POST" id="formulario">
                @csrf
                <div class="row ml-2 mt-2">
                    <div class="form-group col-10">
                      <input type="text" id="search-input" placeholder="Insira o nome produto" name="pesquisa" class="form-control">   
                    </div>
                    <div class="form-group col-1">
                        <button type="submit" class="btn btn-sm btn-secondary" style="font-size:18px;"><i class="btn btn-sm btn-secondary material-icons" style="font-size:18px;" id="search-button">search</i></button>  
                    </div>

                </div>     
            </form>
        </div>
        
    </div>

    <div class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a href="#ativos" class="nav-link active" role="tab" data-toggle="tab"> 
                @if($flag == 1)
                    <h5>Produtos Inativos</h5>
                @else
                    <h5>Produtos</h5>
                @endif

            </a>       
        </li>   
    </div>

    <div class="tab-content">
        <div class="tab-pane active" role="tabpane11" id="ativos">
            <table class="table text-center">
                <thead class="card-header">
                    <div class="col-12 text-right">
                        @if($flag == 0)
                            <a href="{{url('/estoquemadeireira/produtos/create')}}" class="btn btn-success btn-sm mt-2 mb-3">
                                <i class="material-icons" style="vertical-align:middle; font-size:25px;">note_add</i>Adicionar produto
                            </a>
                            <a href="{{url('/estoquemadeireira/produtos/inativos')}}" class="btn btn-danger btn-sm mt-2 mb-3">
                                <i class="material-icons" style="vertical-align:middle; font-size:25px;">delete</i>Produtos Inativos
                            </a>
                        @else
                            <a href="{{url('/estoquemadeireira/produtos')}}" class="btn btn-info btn-sm mt-2 mb-2" >
                                <i class="material-icons" style="vertical-align:middle; font-size:25px;">keyboard_backspace</i>Voltar
                            </a>
                        @endif
                    </div>

                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Fornecedor</th>
                        @if($flag == 0)
                        <th scope="col">Editar</th>
                        <th scope="col">Visualizar</th>
                        @else
                        <th scope="col">Restaurar</th>
                        @endif
  
                        </thead>

                    <tbody>
                        @if(isset($estoque))
                        @foreach($estoques as $estoque)
                            <tr>
                                <td>{{$estoque->nome}}</td>
                                <td>{{$estoque->categoria->nome}}</td>
                                <td>{{$estoque->quantidade}}</td>
                                <td>{{$estoque->fornecedor->nome}}</td>
                                @if($flag == 0)
                                    <td>  
                                    <a href="{{url('/estoquemadeireira/' . $estoque->id . '/edit')}}"><button class="btn btn-sm btn-warning"><i class="material-icons" style="font-size:18px;">border_color</i></button></a>
                                    </td>
                                    <td>
                                    <a href="{{url('/estoquemadeireira/ficha/' . $estoque->id)}}"><button class="btn btn-sm" style="font-size: 0px; background-color:blue;">
                                <i class="material-icons" style="font-size:18px;">remove_red_eye</i></button></a>
                                    </td>
                                @else
                                    <td>
                                        <form method="POST" action="{{url('/estoquemadeireira/' . $produto->id. '/restore')}}">
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
                                        Página {{$estoques->currentPage()}} de {{$estoques->lastPage()}}
                                        -Exibido {{$estoques->perPage()}} registro(s) por página de {{$estoques->total()}}
                                    </p>
                                </td>
                            </tr>
                            @if($produtos->lastPage() > 1)
                            <tr>
                                <td colspan="100%" class="text-center">
                                    {{ $produtos->links() }}
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