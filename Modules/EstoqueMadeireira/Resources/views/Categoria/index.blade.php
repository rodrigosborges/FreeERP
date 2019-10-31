@extends('estoquemadeireira::layouts.master')
@section('title', 'Categorias')
@section('content')

<div class="container">
    <div class="card col-md-12">
        <div class="card-body"> 
            <div class="header text-left">
                <h4>Pesquisar Categoria</h4>
            </div>
            <form action="{{url('estoquemadeireira/produtos/categorias/busca')}}" method="POST" id="form">
            @csrf
            <div class="row">
                    <div class="form-group col-8">
                        <input type="text" id="search-input" maxlength="40" placeholder="Insira o nome da Categoria" class="form-control" name="pesquisa">
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
                @if($flag == 1)
                    <h5>Categorias Inativas</h5>
                @else
                    <h5>Categorias</h5>
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
                            <a href="{{url('/estoquemadeireira/produtos/categorias/create')}}" class="btn btn-success btn-sm mt-2 mb-3">
                                <i class="material-icons" style="vertical-align:middle; font-size:25px;">note_add</i>Adicionar 
                            </a>
                            <a href="{{url('/estoquemadeireira/produtos/categorias/inativos')}}" class="btn btn-danger btn-sm mt-2 mb-3">
                                <i class="material-icons" style="vertical-align:middle; font-size:25px;">delete</i>Categorias Inativas
                            </a>
                        @else
                            <a href="{{url('/estoquemadeireira/produtos/categorias')}}" class="btn btn-info btn-sm mt-2 mb-2" >
                                <i class="material-icons" style="vertical-align:middle; font-size:25px;">keyboard_backspace</i>Voltar
                            </a>
                        @endif
                    </div>

                    <tr>
                        <th scope="col">Nome</th>
                        @if($flag == 0)
                        <th scope="col">Editar</th> 
                        <th scope="col">Desativar</th>              
                        @else
                        <th scope="col">Restaurar</th>
                        @endif
  
                        </thead>

                    <tbody>
                        @if(isset($categorias))
                        @foreach($categorias as $categoria)
                            <tr>
                                <td>{{$categoria->nome}}</td>
                                @if($flag == 0)
                                    <td>  
                                    <a href="{{url('/estoquemadeireira/produtos/categorias/' . $categoria->id . '/edit')}}"><button class="btn btn-sm btn-warning"><i class="material-icons" style="font-size:18px;">border_color</i></button></a>
                                    </td>
                                    <td>
                                    <form method="POST" action="{{url('/estoquemadeireira/produtos/categorias/' . $categoria->id)}}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger ml-3">Desativar</button>
                                  </form>
                                    </td>
                                @else
                                    <td>
                                        <form method="POST" action="{{url('/estoquemadeireira/produtos/categorias/' . $categoria->id. '/restore')}}">
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
                                        Página {{$categorias->currentPage()}} de {{$categorias->lastPage()}}
                                        -Exibido {{$categorias->perPage()}} registro(s) por página de {{$categorias->total()}}
                                    </p>
                                </td>
                            </tr>
                            @if($categorias->lastPage() > 1)
                            <tr>
                                <td colspan="100%" class="text-center">
                                    {{ $categorias->links() }}
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