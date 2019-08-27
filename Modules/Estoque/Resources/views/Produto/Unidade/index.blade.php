@extends('estoque::template')
@section('title', 'Cadastro de Produto')

@section('content')
<div class="container col-6">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Categoria</th>
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
            <td>Soon</td>
            <td>{{$produto->preco_venda}}</td>
            <td><a href="{{url('/estoque/produto/' . $produto->id . '/edit')}}"><button class="btn btn-success">Editar</button></a></td>
        </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection