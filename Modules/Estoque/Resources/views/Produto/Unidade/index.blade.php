@extends('estoque::template')
@section('title', 'Cadastro de Produto')

@section('content')
<div class="container col-6">
    <div class="row" style="margin-bottom: 20px; float: right;">
        <a href="{{url('/estoque/produto/unidade/create')}}"><button class="btn btn-primary">Cadastrar</button></a>
    </div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach($unidadeProduto as $unidade)
        <tr>
            <td>{{$unidade->id}}</td>
            <td>{{$unidade->tipo}}</td>
            <td style="display: flex; flex-direction: row;"><a href="{{url ('/estoque/produto/unidade/' . $unidade->id . '/edit')}}"><button class="btn btn-primary">Editar</button></a>
            <form method="POST" action="{{url('/estoque/produto/unidade/' . $unidade->id)}}">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-warning">Desativar</button>
            </form>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach($unidadesExcluidas as $unidade)
        <tr>
            <td>{{$unidade->id}}</td>
            <td>{{$unidade->tipo}}</td>
            <td style="display: flex; flex-direction: row;">
            <form action="{{url ('/estoque/produto/unidade/' . $unidade->id . '/restore')}}" method="POST">
            @method('PUT')
            @csrf
            <button type="submit" class="btn btn-primary">Restaurar</button>
            </form>
            </td>
        </tr>
    @endforeach
  </tbody>

  
</table>

</div>
@endsection