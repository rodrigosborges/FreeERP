@extends('assistencia::layouts.master')


@section('css')

@stop

@section('content')

<div class="card">
  <div class="card-body">
    <div class="row ">
      <div class="col-md-11 text-left">
        <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
      </div>

    </div>
    <div class="row">
        <form class="input-group mb-3 col-md-6" action="{{route('servicos.buscar')}}" method="post">
            {{ csrf_field() }}
              <input type="text" class="form-control" name="busca" placeholder="Nome da mão-de-obra" aria-label="Buscar" aria-describedby="button-addon2">
              <div class="input-group-append">
                <input class="btn btn-outline-secondary" type="submit" id="button-addon2"></input>
              </div>
        </form>

        <div class="col-md-6">
            <div class="text-right">
                <a href="{{route('servicos.cadastrar')}}"><button type="button" class="btn btn-info">Cadastrar serviço</button></a>
            </div>
        </div>
    </div>
    <div class="card">
      <div class="table-responsive">
        <table class="table table-striped">
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
              @foreach ($servicos as $servico)
                <tr>
                  <td scope="row">{{$servico->nome }}</td>
                  <td>R$ {{$servico->valor }}</td>
                  <td>
                    <a href="{{route('servicos.editar',$servico->id)}}"><button type="button" class="btn btn-secondary">Editar</button></a>
                    <a href="{{route('servicos.deletar',$servico->id)}}"><button type="button" class="btn btn-danger">Deletar</button></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </div>
        </table>
      </div>
    </div>
  </div>
</div>






@stop
