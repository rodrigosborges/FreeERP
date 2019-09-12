@extends('funcionario::template')

@section('title','Aviso de Férias')

@section('body')

    <div class="row d-flex justify-content-center">
           <div class="col">
             <h4 class="font-weight-bold">Dados do Funcionário</h4>
             <hr>
           </div>           
    </div>

    <div class="row">
        <div class="col-4  d-flex justify-content-start" >
            @foreach($funcionarios as $funcionario)
              <p class="font-weight-bold">Nome:&nbsp</p>  {{$funcionario->nome}}
            @endforeach
         </div>

         <div class="col d-flex justify-content-end">
         @foreach($cargo as $cargo)
         <p class="font-weight-bold">Cargo:&nbsp</p>{{$cargo->nome}}
            @endforeach       
         </div>
    </div>

    <div class="row mt-2 d-flex justify-content-start">
            <div class="col-3 d-flex justify-content-start" >
            <p class="font-weight-bold">Carteira de Trabalho:</p>
            </div>

        <div class="col-3">
        <p class="font-weight-bold">Série: </p>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h4 class="font-weight-bold mt-2">Aviso</h4>
        <hr>
            <p class="mt-4 ">Comunicamos-lhe na forma do artigo 135/CLT, que suas férias relativas ao período de (inicia)  a (termina) 
             se iniciarão no dia  <strong>{{date('d/m/Y', strtotime($ferias->data_inicio))}}</strong> e terminarão no dia <strong>{{{date('d/m/Y', strtotime($ferias->data_fim))}}}</strong>  próximo</p>
        </div>
    </div>

    
    <div class="row-5 d-flex justify-content-between">
        <div class="col-4 mt-5" style="border-top: solid 1px">
            <p>Assinatura do Funcionario</p>
        </div>

        <div class="col-4 mt-5" style="border-top: solid 1px">
            <p>Assinatura da Empresa</p>
        </div>
    </div>
    <hr>


    <!-- <table class="table">
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
    </table> -->
@endsection
