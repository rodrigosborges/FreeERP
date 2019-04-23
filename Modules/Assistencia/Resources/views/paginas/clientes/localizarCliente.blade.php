@extends('assistencia::layouts.master')


@section('css')

@stop

@section('content')
<div class="container">

  <div class="row ">
    <div class="col-md-11 text-left">
        <a href="{{url('/assistencia')}}"<i class="material-icons mr-2">arrow_back</i></button></a>
    </div>
  </div>
  <div class="row">
      <div class="col-md-4">
          <form id="form">
              <div class="form-group">
                  <input id="search-input" class="form-control" type="text" name="pesquisa" />
              </div>
          </form>
      </div>
      <div class="col-md-2 pl-0">
          <div class="form-group">
              <i id="search-button" class="btn btn-info material-icons">search</i>
          </div>
      </div>
      <div class="col-md-6">
          <div class="text-right">
              <a href="{{route('cliente.cadastrar')}}"><button type="button" class="btn btn-info">Cadastrar Cliente</button></a>
          </div>
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

</div>








@stop
