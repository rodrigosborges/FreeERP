@extends('ordemservico::layouts.informacoes')
@section('content')
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Minhas OS</h5>
        <p class="card-text">Ordens de Serviços que o técnico {{$data['model']->nome}} é responsável</p>
        <a href="{{route('modulo.tecnico.painel.minhasOs',$data['model']->id)}}" class="btn btn-primary">Visitar</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Ordens que Necessitam de um Técnico</h5>
        <p class="card-text">Ordens em aberto que não possuem técnicos responsáveis</p>
        <a href="{{route('modulo.tecnico.painel.ordens_disponiveis')}}" class="btn btn-primary">Visitar</a>
      </div>
    </div>
  </div>
</div>
@endsection