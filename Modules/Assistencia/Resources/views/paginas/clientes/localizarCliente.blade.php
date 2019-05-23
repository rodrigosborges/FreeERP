@extends('assistencia::layouts.master')

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row ">
      <div class="col-12">
        <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
      </div>
    </div>
    <div class="form-group row">
      <form class="input-group col-lg-9 col-sm-12" action="{{route('cliente.buscar')}}" method="post">
          {{ csrf_field() }}
            <input type="text" class="form-control" name="busca" placeholder="Nome do cliente" aria-label="Buscar cliente" aria-describedby="button-addon2">
            <div class="input-group-append">
              <input class="btn btn-outline-secondary" type="submit" value="Localizar" id="button-addon2"> 
            </div>
      </form>
      <div class="col-lg-3 col-sm-12 text-center">
          <a href="{{route('cliente.cadastrar')}}"><button type="button" class="btn btn-info">Cadastrar Cliente</button></a>
      </div>
    </div>
    <div class="row-center">
      @include('assistencia::paginas.clientes._table')
    </div>
  </div>
</div>

@stop
