@extends('estoquemadeireira::layouts.master')
@section('title', 'Produtos')
@section('content')

<div class="container">
    <div class="card col-md-12">
        <div class="card"> 

            
        
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
                        <th scope="col">Preço</th>
                        <th scope="col">Fornecedor</th>
                        @if($flag == 0)
                        <th scope="col">Editar</th>
                        <th scope="col">Visualizar</th>
                        @else
                        <th scope="col">Restaurar</th>
                        @endif
  
                        </thead>

                    <tbody>
                        @if(isset($produtos))
                        @foreach($produtos as $produto)
                            <tr>
                                <td>{{$produto->nome}}</td>
                                <td>{{$produto->categoria->nome}}</td>
                                <td>{{$produto->preco}}</td>
                                <td>{{$produto->fornecedor->nome}}</td>
                                @if($flag == 0)
                                    <td>  
                                    <a href="{{url('/estoquemadeireira/produtos/' . $produto->id . '/edit')}}"><button class="btn btn-sm btn-warning"><i class="material-icons" style="font-size:18px;">border_color</i></button></a>
                                    </td>
                                    <td>
                                    <a href="{{url('/estoquemadeireira/produtos/ficha/' . $produto->id)}}"><button class="btn btn-sm" style="font-size: 0px; background-color:blue;">
                                <i class="material-icons" style="font-size:18px;">remove_red_eye</i></button></a>
                                    </td>
                                @else
                                    <td>
                                        <form method="POST" action="{{url('/estoquemadeireira/produtos/' . $produto->id. '/restore')}}">
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
                                        Página {{$produtos->currentPage()}} de {{$produtos->lastPage()}}
                                        -Exibido {{$produtos->perPage()}} registro(s) por página de {{$produtos->total()}}
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