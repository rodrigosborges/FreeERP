@extends('funcionario::template')
@section('title', $data['title'])

@section('content')
<div class="card">
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

@stop