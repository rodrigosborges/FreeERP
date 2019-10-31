@extends('estoquemadeireira::layouts.master')
@section('title', 'Produtos')
@section('content')

<div class="container">
    <div class="card col-md-12">
        <div class="card-body"> 
            <div class="header text-left mb-4">
                <h4>Pesquisar Produto</h4>
            </div>
            
            <form method="POST" id="form" action="{{url('/estoquemadeireira/produtos/busca/')}}">
                @csrf
                <div class="row">
                    <div class="form-group col-8">
                        <input type="text" id="search-input" maxlength="40" placeholder="Insira o nome do produto" class="form-control" name="pesquisa">
                    </div>            
                </div>

                <div class="row">
                    <div class="form-group col-7">
                        <select name="categoria_id" id="" class="form-control">
                            <option value="-1">Todas as Categorias</option>
                            @foreach($categorias as $categoria)
                             <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                            @endforeach
                        </select>                      
                    </div>
                    <input type="text" name="flag" hidden value="{{$flag}}">
                            <div class="form-group col-2">
                                <input type="text" name="precoMin" class="form-control" onkeyUp="moeda(this);" placeholder="Preço minimo">
                            </div>
                            <div class="form-group col-2">
                                <input type="text" name="precoMax" class="form-control" onkeyUp="moeda(this);" placeholder="Preço máximo">
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

<script>
    function moeda(i) {
        var v = i.value.replace(/\D/g,'');
        v = (v/100).toFixed(2) + '';
        v = v.replace(",", ".");
        v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1$2$3.");
        v = v.replace(/(\d)(\d{3}),/g, "$1$2.");
        i.value = v;
    }
</script>