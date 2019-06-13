@extends('assistencia::layouts.master')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <h4>Ordem de serviço</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-6">
          Logo da empresa
        </div>
        <div class="col-6 text">
          Numero {{$conserto->numeroOrdem}}
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-6 row">
          <div class="col-12 text-center">
            <h5>Cliente</h5>
            <hr>
          </div>

          <div class="col-6">
            {{$conserto->cliente->nome}}
          </div>
          <div class="col-6">
            {{$conserto->cliente->celnumero}}
          </div><div class="col-6">
            {{$conserto->cliente->cpf}}
          </div>
          <div class="col-6">
            {{$conserto->cliente->telefonenumero}}
          </div>

        </div>
        <div class="col-6 row">
          <div class="col-12 text-center">
            <h5>Aparelho</h5>
            <hr>
          </div>

          <div class="col-6">
            Modelo: {{$conserto->modelo_aparelho}}
          </div>
          <div class="col-6">
            Serial: {{$conserto->serial_aparelho}}
          </div><div class="col-6">
            Marca: {{$conserto->marca_aparelho}}
          </div>
          <div class="col-6">
            IMEI: {{$conserto->imei_aparelho}}
          </div>

        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-12 text-center">
          <h3>Defeito/Reclamação</h3>
          <hr>
        </div>
        <div class="col-6">
          Defeito: {{$conserto->defeito}}
        </div>
        <div class="col-6">
          Observações: {{$conserto->obs}}
        </div>

      </div>
      <hr>
      <div class="row">
        <div class="col-12 text-center">
          <h4>Montagem</h4>
          <hr>
        </div>
        <div class="col-6 row text-center">
          <div class="col-12">
            <h5>Peças</h5>
            <hr>
          </div>
          @foreach ($itemPeca as $peca)
          <div class="col-12 text-center">
            {{$peca->peca->nome}} | R${{$peca->peca->valor_venda}}
          </div>

          @endforeach
        </div>
        <div class="col-6 row">
          <div class="col-12 text-center">
            <h5>Mão de obra</h5>
            <hr>
          </div>
          @foreach ($itemServico as $servico)
            <div class="col-12 text-center">
              {{$servico->servico->nome}} | R${{$servico->servico->valor}}
            </div>

          @endforeach
        </div>
      </div>

      <hr>
      <div class="row text-center">
        <div class="col-12 ">
          <h4>Valor a ser pago</h4>
          <hr>
        </div>
        <div class="col-4">
          Peças:
        </div>
        <div class="col-4">
          Mão de obra:
        </div>
        <div class="col-4">
          Valor total:
        </div>
      </div>
    </div>
  </div>
</div>

@stop
