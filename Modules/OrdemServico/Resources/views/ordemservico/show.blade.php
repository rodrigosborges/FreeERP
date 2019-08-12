@extends('ordemservico::layouts.informacoes')
@section('content')
<div class="card " style="margin:auto; max-width: 40rem;">
  <div class="card-header bg-dark text-white">ID :{{ $data['model']->id }} </div>
  <div class="card-body">
    <p class="card-text text-info">Solicitante </p>
    <p class="card-text text-secondary"> Nome: {{ $data['model']->solicitante->nome}}</p>
    <hr>
    
    <p class="card-text text-info">Aparelho</p>
    <p class="card-text text-secondary"> Marca: {{ $data['model']->aparelho->marca}}</p>
    <p class="card-text text-secondary"> Tipo Aparelho: {{ $data['model']->aparelho->tipo_aparelho}}</p>
    <hr>
    
    <p class="card-text text-info" >Problema</p>
    <p class="card-text text-secondary"> Titulo: {{ $data['model']->problema->titulo}}</p>
    <p class="card-text text-secondary"> Prioridade: {{ $data['model']->problema->prioridade}}</p>
    
    
    <hr>
    <p class="card-text text-info">Descricao:</p>
    <p class="card-text text-secondary">{{ $data['model']->descricao}}</p>
    
    
    <a href="{{ url('ordemservico/os') }}" class="btn btn-primary">Voltar</a>
  </div>
</div>
@endsection