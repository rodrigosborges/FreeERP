@extends('assistencia::layouts.master')
@section('css')
<style type="text/css">
.importante {
    font-size: 25px;
    color: red;
    font-weight:
}
</style>
@stop
@section('content')

<div class="card">
    <div class="card-header">
        Confirmação de pagamento
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                Ordem de serviço Nº {{$pagamento->conserto->id}}
            </div>
            <div class="col-4">
                Modelo do aparelho: {{$pagamento->conserto->modelo_aparelho}}
            </div>
            <div class="col-4">
                Defeito: {{$pagamento->conserto->defeito}}
            </div>
            <div class="col-4">
                Valor a ser pago: <span class="importante">R${{$pagamento->valor}}</span>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                Cliente
            </div>
            <div class="col-4">
                Nome: {{$pagamento->cliente->nome}}
            </div>
            <div class="col-4">
                CPF: {{$pagamento->cliente->cpf}}
            </div>
            <div class="col-4">
                Telefone/Celular: {{$pagamento->cliente->celnumero}}
            </div>
        </div>
        <hr>
        <form class="" action="{{route('pagamento.salvar', $pagamento->id)}}" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="forma">Forma de pagamento</label>
                        <select class="form-control" name="forma" id="forma">
                            <option value="1">Dinheiro</option>
                            <option value="2">Cartão</option>
                        </select>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            Deseja emitir o recibo?
                        </div>
                        <div class="col-2">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="reciboSim" name="recibo" required value="S" class="custom-control-input">
                                <label class="custom-control-label" for="reciboSim">Sim</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="reciboNao" name="recibo" value="N" class="custom-control-input">
                                <label class="custom-control-label" for="reciboNao">Não</label>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

            <div class="row text-center">
                <div class="col-12">
                    <button type="submit" class="btn btn-succes">Confirmar pagamento</button>
                </div>
            </div>

        </form>
    </div>
</div>



@stop
@section('js')
<script type="text/javascript">

</script>
@stop