@extends('ordemservico::layouts.informacoes')
@section('content')
<div class="card " style="margin:auto; max-width: 40rem;">
  <div class="card-header bg-info text-white">Protocolo : {{ $data['model']->protocolo }} </div>
  <div class="card-body">
    <p class="card-text text-info">Tecnico Responsável</p>
    <p class="card-text text-secondary"> Nome: {{ $data['model']->tecnico->apelido}}</p>
    <p class="card-text text-info">Solicitante </p>
    <p class="card-text text-secondary"> Nome: {{ $data['model']->solicitante->nome}}</p>
    <p class="card-text text-secondary"> Identificacao: {{ $data['model']->solicitante->identificacao}}</p>
    @foreach($data['model']->solicitante->telefones as $telefone)
    <p class="card-text text-secondary"> Telefone: {{$telefone->numero}}</p>
    @endforeach
    <hr>

    <p class="card-text text-info">Endereco </p>
    <p class="card-text text-secondary"> CEP: {{ $data['model']->solicitante->endereco->cep}}</p>
    <p class="card-text text-secondary"> Estado: {{ $data['model']->solicitante->endereco->estado->nome}}</p>
    <p class="card-text text-secondary"> Cidade: {{ $data['model']->solicitante->endereco->cidade->nome}}</p>
    <p class="card-text text-secondary"> Rua: {{ $data['model']->solicitante->endereco->rua}}</p>
    <p class="card-text text-secondary"> Bairro: {{ $data['model']->solicitante->endereco->bairro}}</p>
    <p class="card-text text-secondary"> Numero: {{ $data['model']->solicitante->endereco->numero}}</p>
    <p class="card-text text-secondary"> Complemento: {{ $data['model']->solicitante->endereco->complemento}}</p>
    <hr>

    <p class="card-text text-info">Aparelho</p>
    <p class="card-text text-secondary"> Marca: {{ $data['model']->aparelho->marca}}</p>
    <p class="card-text text-secondary"> Tipo Aparelho: {{ $data['model']->aparelho->tipo_aparelho}}</p>
    <p class="card-text text-secondary"> Modelo: {{ $data['model']->aparelho->modelo}}</p>
    <p class="card-text text-secondary"> Marca: {{ $data['model']->aparelho->marca}}</p>
    <p class="card-text text-secondary"> Acessórios: {{ $data['model']->aparelho->acessorios}}</p>
    <hr>

    <p class="card-text text-info">Problema</p>
    <p class="card-text text-secondary"> Titulo: {{ $data['model']->problema->titulo}}</p>

    <hr>
    <p class="card-text text-info">Descricao:</p>
    <p class="card-text text-secondary">{{ $data['model']->descricao}}</p>
    <hr>
    <p class="card-text text-secondary"> Prioridade: {{ $data['model']->prioridade}}</p>

    <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
  </div>
</div>
@endsection