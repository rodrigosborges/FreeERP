@extends('estoque::template')
@section('title', 'Cadastro de Produto')
@section('content')
<div class="container col-8">
    <h2 class="container-title">Produtos Ativos</h2>
    <div class="row" style="margin-bottom: 20px; float: right;">
        <a href="{{url('/estoque/produto/create')}}"><button class="btn btn-primary">Cadastrar</button></a>
    </div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Categoria</th>
      <th scope="col">Unidade</th>
      <th scope="col">Estoque</th>
      <th scope="col">Preço</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach($produtos as $produto)
        <tr>
            <td>{{$produto->id}}</td>
            <td>{{$produto->nome}}</td>
            <td>{{$produto->categoria->nome}}</td>
            <td>{{$produto->unidade->tipo}}</td>
            <td>Soon</td>
            <td>{{$produto->preco_venda}}</td>
            <td style="display: flex; flex-direction: row;"><a href="{{url('/estoque/produto/' . $produto->id . '/edit')}}"><button class="btn btn-success">Editar</button></a>
            <form method="POST" action="{{url('/estoque/produto/' . $produto->id)}}">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-warning">Desativar</button>
            </form>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>
</div>

<div class="container col-8">
    <h2 class="container-title">Produtos Inativos</h2>
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Categoria</th>
            <th scope="col">Unidade</th>
            <th scope="col">Estoque</th>
            <th scope="col">Preço</th>
            <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtosInativos as $produto)
                <tr>
                    <td>{{$produto->id}}</td>
                    <td>{{$produto->nome}}</td>
                    <td>{{$produto->categoria->nome}}</td>
                    <td>{{$produto->unidade->tipo}}</td>
                    <td>Soon</td>
                    <td>{{$produto->preco_venda}}</td>
                    <td>
                    <form method="POST" action="{{url('/estoque/produto/' . $produto->id . '/restore')}}">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn btn-warning">Restaurar</button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


</div>


@endsection