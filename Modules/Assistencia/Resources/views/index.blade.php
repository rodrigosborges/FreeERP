@extends('assistencia::layouts.master')

@section('title','Assistência Técnica')

@section('css')
@stop

@section('content')

  <div class="container text-center">
    <div class="card-body">
      <div class="row">
        <div class="col">
          <a href="{{route('concertos.index')}}">
            <h3>Concertos</h3>
            LINK CONCERTOS
          </a>
        </div>
        <div class="col">
          <a href="{{route('cliente.index')}}">
            <h3>Clientes</h3>
            LINK CLIENTE
          </a>
        </div>
        <div class="col">
          <a href="{{route('estoque.index')}}">
            <h3>Estoque</h3>
            LINK ESTOQUE
          </a>
        </div>
        <div class="col">
          <a href="{{route('pagamento.index')}}">
            <h3>Pagamentos</h3>
            LINK PAGAMENTOS
          </a>
        </div>
      </div>


    </div>

  </div>




@stop
