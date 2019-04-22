@extends('assistencia::layouts.master')


@section('css')

@stop

@section('content')
<div class="container">

    <div class="form-group">
      <div class="form-row">
          <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Nome do cliente" aria-label="Search">
          <button type="button" class="btn btn-primary" name="button">Buscar</button>
      </div>
    </div>


  <table class="table table-striped table-dark">
    <div class="row">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">CPF</th>
          <th scope="col">Nascimento</th>
          <th scope="col">Celular</th>
          <th scope="col">Telefone</th>
          <th scope="col">Ações</th>
        </tr>

      </thead>
    </div>
    <div class="row">
      <tbody>
        @foreach ($clientes as $cliente)
          <tr>
            <td scope="row">{{$cliente->nome }}</td>
            <td>{{$cliente->cpf }}</td>
            <td>{{$cliente->data_nascimento }}</td>
            <td>{{$cliente->celnumero }}</td>
            <td>{{$cliente->telefonenumero }}</td>
            <td>
              <a href="{{route('cliente.editar',$cliente->id)}}"><button type="button" class="btn btn-secondary">Editar</button></a>
              <a href="{{route('cliente.deletar',$cliente->id)}}"><button type="button" class="btn btn-danger">Deletar</button></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </div>
  </table>

  <div class="row">
    <a href="{{route('cliente.cadastrar')}}"><button type="button" class="btn btn-info">Cadastrar Cliente</button></a>
  </div>
</div>








@stop
