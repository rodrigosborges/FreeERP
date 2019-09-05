@extends('funcionario::template')

@section('body')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Data de início</th>
                <th scope="col">Data de fim</th>
                <th scope="col">Dias de férias</th>
                <th scope="col">Data de pagamento</th>
                <th scope="col">Data de aviso</th>
                <th scope="col">Situação das férias</th>
                <th scope="col">Pagamento parcela 13º</th>
                <th scope="col">Observações</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>{{date('d/m/Y', strtotime($ferias->data_inicio))}}</td>
                <td>{{date('d/m/Y', strtotime($ferias->data_fim))}}</td>
                <td>{{$ferias->dias_ferias}}</td>
                <td>{{date('d/m/Y', strtotime($ferias->data_pagamento))}}</td>
                <td>{{date('d/m/Y', strtotime($ferias->data_aviso))}}</td>
                <td>
                    @if($ferias->situacao_ferias == 'naoMarcadas')
                        {{'Não marcadas'}}
                    @else
                        {{'Marcadas'}}
                    @endif
                </td>
                <td>    
                    @if($ferias->pagamento_parcela13 == 1)
                        {{'Sim'}}
                    @else
                        {{'Não'}}    
                    @endif    
                </td>
                <td>{{$ferias->observacao}}</td>
            </tr>
        </tbody>
    </table>
@endsection
