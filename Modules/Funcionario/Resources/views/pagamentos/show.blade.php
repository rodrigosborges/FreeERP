@extends('funcionario::template')
@section('title', $data['title'])

@section('body')
<button class="imprimir-button btn btn-primary"><i class="material-icons">print </i></button>
<div id="show">
    <div class="card-body">
        <table class="table table-bordered border border-primary text-left">
            <tr>
                <td colspan="3">
                 <b><p>Nome da Empresa</p></b>
                    <p>Rua Silvio Santos, 10</p>
                    <p>00.000.000/0001-10</p>
                </td>
                <td colspan="3">
                    <b><p>Data de Referência</p></b>
                    <p>{{ $data['pagamento']->emissao}}</p>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <span class="p"><b>Nome: </b>{{ $data['pagamento']->funcionario->nome}}</span>
                    <span class="p"><b>Cargo: </b>{{ $data['pagamento']->funcionario->cargos->last()->nome}}</span>
                </td>
                <td colspan="1">
                    <span class="p"><b>Folha:</b> {{$data['pagamento']->id}}</span>
                </td>
            </tr>
            <tr>
                <td colspan="1">
                    <b><p>Descrição</p></b>

                </td>
                <td colspan="3"><b>Referência</b></td>
                <td class="text-success"><b>Vencimentos</b></td>
                <td class="text-danger"><b>Descontos</b></td>
            </tr>
            <tr class="">
                <td colspan="1">
                    <p class="text-success">{{ $data['pagamento']->tipo_pagamento}}</p>
                    <p class="text-success">Horas Extras: </p>
                    <p class="text-success">Adicional Noturno: </p>
                    <p class="text-danger">Faltas: </p>
                    <p class="text-danger">INSS: </p>
                    </td>   
                <td colspan=3>
                    <p class="text-success">{{ 30 - $data['pagamento']->faltas }}</p>
                    <p class="text-success">-----------</p>
                    <p class="text-success">-----------</p>
                    <p class="text-danger">{{ $data['pagamento']->faltas}}</p>
                    <p class="text-danger" >-----------</p>
                </td>
                <td>
                    <p class="text-success">{{ $data['pagamento']->funcionario->cargos->last()->salario}}</p>
                    <p class="text-success">{{ $data['pagamento']->horas_extras }}</p>
                    <p class="text-success">{{ $data['pagamento']->adicional_noturno }}</p>
                </td>
                <td>
                <p class="text-success">-----------</p>
                <p class="text-success">-----------</p>
                <p class="text-success">-----------</p>
                <p class="text-danger">{{ $valorFalta }}</p>
                <p class="text-danger">{{ $data['pagamento']->inss }}</p>
                </td>
            </tr>
            <tr>
                <td colspan=4 >     
                </td>
                <td colspan="1" class="text-success"><b>Total de Vencimentos:</b>
                    <p>{{ $vencimentos }}</p>
                </td>
                <td colspan="2" class="text-danger"><b>Total de Descontos:</b>
                <p>{{ $desconto }}</p>
              </td>              
            </tr>
            <tr>
                <td colspan="6">
                    <span class="total d-flex justify-content-between">
                    <b>Valor Liquído:</b>
                    <i class="material-icons seta">arrow_right_alt</i>
                    <b>R${{ floatVal($vencimentos) - floatVal($desconto) }}</b>
                    </span>
                </td>
            </tr>       
        </table>
</div>
    @stop
    <style>
        span {
            margin-right: 20%;
        }

        .ref {
            margin-top: 30px;
            font-weight: 700;
        }
        .folha{
            margin-right:100px;
        }
        i.seta{
            font-size: 80px;
        }
       .seta{
           margin-left:300px;
           margin-right:100px;
       }
      
    </style>
    @section('js')

<script src="{{Module::asset('funcionario:js/bibliotecas/printThis.js')}}"></script>

<script>
    $(document).on('click','.imprimir-button', function(){
        $(".change-class-2").toggleClass("col-lg-2").toggleClass("col-2");
        $(".change-class-10").toggleClass("col-lg-10").toggleClass("col-10");
        var dNow = new Date();
        var day = dNow.getDate() < 10 ? "0"+dNow.getDate() : dNow.getDate()
        var month = dNow.getMonth() < 9 ? "0"+dNow.getMonth() : dNow.getMonth()
        var hours = dNow.getHours() < 10 ? "0"+dNow.getHours() : dNow.getHours()
        var minutes = dNow.getMinutes() < 10 ? "0"+dNow.getMinutes() : dNow.getMinutes()
        var localdate = day + '/' + month + '/' + dNow.getFullYear() + ' ' + hours + ':' + minutes;

        $("#show").printThis({
            header: "<h1 class='text-center'>Folha de Pagamento<h1><hr><br>",
            footer: `<span class='text-center bottom-center-absolute'>${localdate}<span><hr><br>`,
            afterPrint: function(){
                $(".change-class-2").toggleClass("col-lg-2").toggleClass("col-2");
                $(".change-class-10").toggleClass("col-lg-10").toggleClass("col-10");
            }
        });
    })
</script>

@endsection