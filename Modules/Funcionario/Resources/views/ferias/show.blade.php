@extends('funcionario::template')

@section('title','Aviso de Férias')

@section('body')

    <div class="row d-flex justify-content-center">
           <div class="col">
             <p>Dados do Funcionario</p>
           </div>           
    </div>

    <div class="row" >
        <div class="col-sm-4 d-flex justify-content-center " >
            @foreach($funcionarios as $funcionario)
                {{$funcionario->nome}}
            @endforeach
         </div>

         <div class="col-sm-5 d-flex justify-content-end" >
         @foreach($cargo as $cargo)
                {{$cargo->nome}}
            @endforeach       
         </div>
    </div>

    <div class="row p-3" >
        <div class="col-sm-3">
            <p>Carteira de Trabalho:&nbsp76752</p>
        </div>

        <div class="col-sm-3">
            <p>Série:&nbsp76752</p>
        </div>
    </div>

    <div class="row">
        <div class="col" style="border-bottom: solid 1px">
            <p>Aviso</p>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-sm-10 p-3">
            <p>Comunicamos-lhe na forma do artigo 135/CLT, que suas férias relativas ao período de {{date('d/m/Y', strtotime($ferias->data_inicio))}} a 
            {{{date('d/m/Y', strtotime($ferias->data_fim))}}} se iniciarão no dia (nao sei) e terminarão no dia (nao faço ideia) próximo</p>

        </div>

    </div>
    <div class="col">
        _______________________________________
        <p>Assinatura do Funcionario</p>
    </div>


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
