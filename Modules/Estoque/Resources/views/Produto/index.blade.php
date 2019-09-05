@extends('estoque::template')
@section('title', 'Lista de Produtos')
@section('content')
<div class="container">
    <div class="card col-md-12">
        <div class="header mt-3">
            <h3 class="text-center">Produto</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('/estoque/produto/busca')}}" id="form">
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <input id="search-input" placeholder="Insira o nome do produto" class="form-control" type="text" name="pesquisa" />
                    </div>
                    <div class="form-group col-5">
                        <select class="form-control" name="categoria_id">
                            <option value="-1">Todas Categorias</option>
                            @foreach($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-1">
                        <button type="submit" class="btn btn-dark material-icons"><i id="search-button">search</i></button>
                    </div>
                </div>
                <div class="row">
                        <div class="form-group col-3">
                            <input type="text" name="preco_min" class="form-control" placeholder="Preço minimo">
                        </div>
                        <div class="form-group col-3">
                            <input type="text" name="preco_max" class="form-control" placeholder="Preço máximo">
                        </div>
                </div>
            </form>
            
            
            <div class="row">
                <div class="col-12 text-right">
                    <a class="btn btn-success" href="{{url('/estoque/produto/create')}}">Novo Produto</a>
                </div>
            </div>

            <ul class="nav nav-tabs  justify-content-center">
                <li class="nav-item">
                    <a href="#ativos" class="nav-link active" role="tab" data-toggle="tab">
                    Produtos Ativos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#inativos" class="nav-link" role="tab" data-toggle="tab">
                    Produtos Inativos
                    </a>
                </li>
            </ul>
            <div class=" tab-content row justify-content-center ">
                <div class="tab-pane active col-sm-10" role="tabpanel1" id="ativos">
                    <table class="table mt-3">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Visualizar</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Deletar</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($produtos))
                            @foreach($produtos as $produto)
                            <tr>
                                <td>{{$produto->nome}}</td>
                                <td>{{$produto->categoria->nome}}</td>
                                <td>R$ {{$produto->preco}}</td>
                                <td><a href="{{url('/estoque/produto/ficha/' . $produto->id)}}"><button class="btn btn-warning">Visualizar</button></a></td>

                                <td ><a href="{{url('/estoque/produto/' . $produto->id . '/edit')}}"><button class="btn btn-warning">Editar</button></a></td>
                                <td>
                                    <!-- <form method="POST" action="{{url('/estoque/produto/' . $produto->id)}}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Desativar</button>
                                    </form> -->
                                </td>
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
                    </table>
                </div>
                <div class="tab-pane col-sm-10" role="tabpanel1" id="inativos">
                    <div class="justify-content-center">
                        <table class="table mt-3">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Restaurar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($produtosInativos))
                                @foreach($produtosInativos as $produto)
                                <tr>
                                    <td>{{$produto->nome}}</td>
                                    <td>{{$produto->categoria->nome}}</td>
                                    <td>R$ {{$produto->preco}}</td>
                                    <td>
                                        <form method="POST" action="{{url('/estoque/produto/' . $produto->id. '/restore')}}">
                                        @method('put')
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Restaurar</button>
                                    </td>
                                </tr>
                                @endforeach 
                                @endif 
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="100%" class="text-center">
                                        <p class="text-cetner">
                                            Página {{$produtosInativos->currentPage()}} de {{$produtosInativos->lastPage()}}
                                            -Exibido {{$produtosInativos->perPage()}} registro(s) por página de {{$produtosInativos->total()}}
                                        </p>
                                    </td>
                                </tr>
                                @if($produtosInativos->lastPage() > 1)
                                <tr>
                                    <td colspan="100%" class="text-center">
                                        {{ $produtosInativos>links() }}
                                    </td>
                                </tr>
                                @endif
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection