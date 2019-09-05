@extends('estoque::template')
@section('title', 'Lista de Produtos')
@section('content')
<div class="container">
    <div class="card col-md-12">
        <div class="card-body">
            <div class="header text-left mb-3 mt-3">
                <h4>Pesquisar Produto</h4>
            </div>
                <form method="POST" action="{{url('/estoque/produto/busca')}}" id="form">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <input id="search-input" placeholder="Insira o nome do produto" class="form-control" type="text" name="pesquisa" />
                        </div>
                    </div>
                    <div class="row">
                            <div class="form-group col-7">
                                <select class="form-control" name="categoria_id">
                                    <option value="-1">Todas Categorias</option>
                                    @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <input type="text" name="preco_min" class="form-control" onkeyUp="moeda(this);" placeholder="Preço minimo">
                            </div>
                            <div class="form-group col-2">
                                <input type="text" name="preco_max" class="form-control" onkeyUp="moeda(this);" placeholder="Preço máximo">
                            </div>
                            <div class="form-group col-1 text-right">
                                <button type="submit" class="btn btn-dark material-icons"><i id="search-button">search</i></button>
                            </div>
                    </div>
                </form>
            
            
            <div class="row">
                <div class="col-12 text-right pl-2">
                    @if($flag == 0)
                    <a class="btn btn-success" href="{{url('/estoque/produto/create')}}">Novo Produto</a>
                    <a class="btn btn-danger" href="{{url('/estoque/produto/inativos')}}">Inativos</a>
                    @else
                    <a class="btn btn-warning" href="{{url('/estoque/produto')}}">Voltar</a>
                    @endif
                </div>
            </div>

            <ul class="nav nav-tabs  justify-content-center">
                <li class="nav-item">
                    <a href="#ativos" class="nav-link active" role="tab" data-toggle="tab">
                    @if($flag == 1)
                    <h5>Produtos Inativos</h5>
                    @else
                    <h5>Produtos Ativos</h5>
                    @endif
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
                                @if($flag == 0)
                                <th scope="col">Ações</th>
                                <th scope="col">Editar</th>   
                                @else
                                <th scope="col">Restaurar</th>
                                @endif
                                                   
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($produtos))
                            @foreach($produtos as $produto)
                            <tr>
                                <td>{{$produto->nome}}</td>
                                <td>{{$produto->categoria->nome}}</td>
                                <td>R$ {{$produto->preco}}</td>
                                @if($flag == 0)
                                <td><a href="{{url('/estoque/produto/ficha/' . $produto->id)}}"><button class="btn btn-primary">Visualizar</button></a></td>

                                <td ><a href="{{url('/estoque/produto/' . $produto->id . '/edit')}}"><button class="btn btn-warning">Editar</button></a></td>
                                @else
                                <td>
                                    <form method="POST" action="{{url('/estoque/produto/' . $produto->id. '/restore')}}">
                                    @method('put')
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Restaurar</button>
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
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

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