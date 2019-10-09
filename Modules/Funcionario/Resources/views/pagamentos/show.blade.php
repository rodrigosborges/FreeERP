@extends('funcionario::template')
@section('title', $data['title'])

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title text-center">Folha de Pagamento</h3>
    </div>
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
            <tr>
                <td colspan="1">
                    <p>{{ $data['pagamento']->tipo_pagamento}}</p>
                    <p>Horas Extras: </p>
                    <p>Adicional Noturno: </p>
                    <p>Faltas: </p>
                    <p>INSS: </p>
                <td colspan=3>
                    <p>{{ 30 - $data['pagamento']->faltas }}</p>
                    <p>-----------</p>
                    <p>-----------</p>
                    <p>{{ $data['pagamento']->faltas}}</p>
                    <p>-----------</p>
                </td>
                <td>
                    <p class="text-success">{{ $data['pagamento']->funcionario->cargos->last()->salario}}</p>
                    <p class="text-success">{{ $data['pagamento']->horas_extras }}</p>
                    <p class="text-success">{{ $data['pagamento']->adicional_noturno }}</p>
                </td>
                <td>
                <p class="text-danger">-----------</p>
                <p class="text-danger">-----------</p>
                <p class="text-danger">-----------</p>
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
                    <span><b>Valor Liquído:</b><i class="material-icons seta">arrow_right_alt</i><b>R${{ floatVal($vencimentos) - floatVal($desconto) }}</b></span>
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
           margin-right:220px;
       }
    </style>