@extends('assistencia::layouts.master')

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row ">
      <div class="col-md-11 text-left">
        <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
      </div>
    </div>
    <div class="row">
      <form class="input-group mb-3 col-md-6" action="{{route('cliente.buscar')}}" method="post">
          {{ csrf_field() }}
            <input type="text" class="form-control" name="busca" placeholder="Nome do cliente" aria-label="Buscar cliente" aria-describedby="button-addon2">
            <div class="input-group-append">
              <input class="btn btn-outline-secondary" type="submit" value="Localizar" id="button-addon2"></input>
            </div>
      </form>
      <div class="col-md-6">
          <div class="text-right">
              <a href="{{route('cliente.cadastrar')}}"><button type="button" class="btn btn-info">Cadastrar Cliente</button></a>
          </div>
      </div>
    </div>
    @include('assistencia::paginas.clientes._table')
  </div>
</div>

@stop
