@extends('assistencia::layouts.master')
@section('css')
<style type="text/css">
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header img {
    width: 60%;
}

.pequeno {
    font-size: 12px;
}
</style>
@stop
@section('content')
<div class="card" style="width:40%;">
    <div class="card-body">
        <div class="row">
            <div class="col-4"><a target="_blank" href="{{route('pagamento.imprimir', $pagamento->id)}}">Imprimir</a></div>
        </div>
        <div class="card-body">
            <div class="header">
                <div class="imagem">
                    <img class="img-fluid" src="{{ URL::to('/') }}/img/logo.png">
                </div>
                <div class="">
                    <h6>Recibo nº {{$pagamento->conserto->numeroOrdem}}</h6>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <p>Recebemos do cliente {{$pagamento->conserto->cliente->nome}}, CPF:
                        {{$pagamento->conserto->cliente->cpf}} a importancia liquida de R${{number_format( $pagamento->conserto->valor , 2, ',', '.')}}
                        referente a ordem de serviço nº{{$pagamento->conserto->numeroOrdem}} na data de {{date("d/m/y")}}.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center">
                    _____________________________________<br>
                    Funcionario
                </div>
            </div>
        </div>
    </div>
</div>
@stop