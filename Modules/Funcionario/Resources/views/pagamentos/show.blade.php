@extends('funcionario::template')
@section('title', $data['title'])

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title text-center">Recibo de Pagamento de Salário</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered border border-primary text-left">
            <tr>
                <td colspan="3">
                    <p>Nome da Empresa</p>
                    <p>Rua Silvio Santos, 10</p>
                    <p>00.000.000/0001-10</p>

                </td>
                <td colspan="3">
                    <p>Data de Referência</p>
                    <p>{{ $data['pagamento']->emissao}}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Nome: {{ $data['pagamento']->funcionario->nome}}</p>
                    <p>Cargo: {{ $data['pagamento']->funcionario->cargos->last()->nome}}</p>
                </td>
                <td>
                    <p>CBO:</p>
                    <p>1234-5</p>
                </td>
                <td>
                    <p>Local:</p>
                    <p>00000</p>
                </td>
                <td>
                    <p>Depto.</p>
                    <p>00001</p>
                </td>
                <td>
                    <p>Setor:</p>
                    <p>00007</p>
                </td>
                <td>
                    <p>Folha:</p>
                    <p>{{$data['pagamento']->id}}</p>
                </td>
            </tr>
            <tr>
                <td colspan="1">
                    <p>Descrição</p>

                </td>
                <td colspan="3">Referência</td>
                <td>Vencimentos</td>
                <td>Descontos</td>
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
                    <p>-------</p>
                    <p>-----------</p>
                    <p>{{ $data['pagamento']->faltas}}</p>
                    <p>-----------</p>
                </td>
                <td>
                    <p>{{ $data['pagamento']->funcionario->cargos->last()->salario}}</p>
                    <p>{{ $data['pagamento']->horas_extras . ',00 '}}</p>
                    <p>{{ $data['pagamento']->adicional_noturno . ',00 '}}</p>
                </td>
                <td><p>-----------</p>
                <p>-----------</p>
                <p>-----------</p>
                <p>{{ $valorFalta }}</p>
                <p>{{ $data['pagamento']->inss }}</p>
                </td>
            </tr>
            <tr>
                <td colspan=4 rowspan=2>
                    <span>Banco:</span>
                    <span>Agencia:</span>
                    <span> CC:</span>
                    <p class="text-center ref">Referente ao Mês de (Mês)/(ano)</p>
                </td>
                <td colspan="1">Total de Vencimentos:
                    <p>{{ $vencimentos . ',00 '}}</p>
                </td>
                <td colspan="2">Total de Descontos:
                <p>{{ $desconto }}</p>
                </td>
              
            </tr>
            <tr>
                <td colspan="4">
                    <span> Valor Liquído </span>
                  <span>  -----></span>
                    <span>{{ floatVal($vencimentos) - floatVal($desconto) }} </span>
                </td>
            </tr>
            <tr>
                <td colspan=100%></td>
            </tr>




        </table>
    </div>
    <!--<div class="card">
    <div class="card-header">
        <h3 class="card-title text-center">Holerite</h3>
    </div>
    <div class="card-body">
       
        <table class="table table-bordered">
            <thead class="thead-light">
            <tr>
               <td colspan=10 class="text-center bold"><b>{{ $data['pagamento']->funcionario->nome}}</b></td>
            </tr>
            <tr>
                
                <th>Cargo</th>
                <th>Emissão</th>
                <th>Tipo Pagamento</th>
                <th>Hora Extra</th>
                <th>Adicional Noturno</th>
                <th>Faltas</th>
                <th>INSS</th>
                <th>Valor</th>
                <th>Total</th>
            </tr>
            </thead>
            <tr>
            <td>{{$data['pagamento']->funcionario->cargos->last()->nome}}</td>
            <td>{{ $data['pagamento']->emissao }}</td>
            <td>{{ $data['pagamento']->tipo_pagamento }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            
            </tr>
        </table>
    </div>
    <div class="card-footer">
    
    </div>
</div>
-->
    @stop
    <style>
        span {
            margin-right: 20%;
        }

        .ref {
            margin-top: 30px;
            font-weight: 700;
        }
    </style>