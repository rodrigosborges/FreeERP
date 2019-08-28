@extends('template')
@section('title', 'Cadastro de Produto')

@section('content')
<div class="container">
    <div class="row" style="margin-bottom: 20px; float: right;">
        <a href="{{url('/estoque/produto/unidade/create')}}"><button class="btn btn-primary">Cadastrar</button></a>
    </div>
<div class="col-md-12">
<table class="table">
  <thead class="thead">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Editar</th>
      <th scope="col">Deletar</th>
    </tr>
  </thead>
  <tbody>
    @foreach($unidadeProduto as $unidade)
        <tr>
            <td>{{$unidade->id}}</td>
            <td>{{$unidade->tipo}}</td>
            <td style="display: flex; flex-direction: row;"><a href="{{url ('/estoque/produto/unidade/' . $unidade->id . '/edit')}}"><button class="btn btn-warning"><i class="material-icons">
edit</i></button></a></td>
            <td>
            <form method="POST" action="{{url('/estoque/produto/unidade/' . $unidade->id)}}">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger"><i class="material-icons">delete</i></button>
            </form>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>

<table class="table">
  <thead class="thead">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Restaurar</th>

      
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
            </form></td>

            
        </tr>
    @endforeach
  </tbody>
</table>

</div>
</div>
@endsection