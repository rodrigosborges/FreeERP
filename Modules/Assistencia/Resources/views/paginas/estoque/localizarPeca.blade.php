@extends('assistencia::layouts.master')


@section('css')

@stop

@section('content')
<div class="container">
    <a href="{{url('/assistencia')}}"<i class="material-icons mr-2">arrow_back</i></button></a>
    <div class="form-group">
      <div class="form-row">
          <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Nome da peça" aria-label="Search">
          <button type="button" class="btn btn-primary" name="button">Buscar</button>
      </div>
    </div>


  <table class="table table-striped table-dark">
    <div class="row">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">Valor</th>
          <th scope="col">Ações</th>
        </tr>

      </thead>
    </div>
    <div class="row">
      <tbody>
        @foreach ($pecas as $peca)
          <tr>
            <td scope="row">{{$peca->nome }}</td>
            <td>R$ {{$peca->valor }}</td>
            <td>
              <a href="{{route('pecas.editar',$peca->id)}}"><button type="button" class="btn btn-secondary">Editar</button></a>
              <a href="{{route('pecas.deletar',$peca->id)}}"><button type="button" class="btn btn-danger">Deletar</button></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </div>
  </table>

  <div class="row">
    <a href="{{route('pecas.cadastrar')}}"><button type="button" class="btn btn-info">Cadastrar Peça</button></a>
  </div>
</div>








@stop
