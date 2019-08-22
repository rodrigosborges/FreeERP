@extends('estoque::template')
@section('title', 'Lista de Produtos')
@section('content')
<div class="container">
<div class="row">
        <div class="col-md-8 mt-3">
            <form id="form">
                <div class="form-group">
                    <div class="input-group">
                        <input id="search-input" placeholder="Pesquisa" class="form-control" type="text" name="pesquisa" />
                        <i id="search-button" class="btn btn-dark material-icons ml-1">search</i>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 mt-3">
            <div class="text-right">
                <a class="btn btn-success" href="{{url('/produto/create')}}">Novo Produto</a>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-5">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Nome</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Preço</th>
                <th scope="col">Editar</th>
                <th scope="col">Deletar</th>
                </tr>
            </thead>
            <tbody>
                <!-- @if(isset($produtos))
                @foreach($produtos as $produto)
                <tr>    
                    <td>{{$produto->nome}}</td>
                    <td>{{$produto->quantidade}}</td>
                    <td>R$ {{$produto->preco}}</td>
                    <td><a href=""><button class="btn btn-warning">Editar</button></a></td>
                    <td><a href=""><button class="btn btn-danger">Deletar</button></a></td>
                </tr>
                @endforeach 
                @endif -->
                <tr>    
                    <td>Nome</td>
                    <td>4</td>
                    <td>R$ 13,20</td>
                    <td><a href=""><button class="btn btn-warning">Editar</button></a></td>
                    <td><a href=""><button class="btn btn-danger">Deletar</button></a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection