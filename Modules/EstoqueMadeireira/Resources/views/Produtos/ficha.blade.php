@extends('estoquemadeireira::layouts.master')
@section('title', 'Ficha de Produto')
@section('content')

<div class="container" style="justify-content: center" id="imprimir">
    <div class="card">
        <div class="card-header">
            Ficha do Produto
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <label for="nome"><span><i class="material-icons" style="vertical-align:middle;">assignment_turned_in</i></span>&nbsp&nbsp<b>Produto</b><br><br>{{$produto->nome }}</label>
                    
                </div>
                <div class="col-md-6">
                    <label for="preco"><i class="material-icons" style="vertical-align:middle;">attach_money</i>&nbsp&nbsp<b>Preço de Venda | de Custo</b><br><br>R${{$produto->preco}} | R${{$produto->precoCusto}}</label>
                </div>

                
            </div>
            <hr>
            
            <div class="row">

                @if(($produto->medida == null) && ($unidadeMedida->id == -1)){
                <div class="col-md-6">
                    <label for="codigo"><i class="material-icons" style="vertical-align:middle;">view_week</i>&nbsp&nbsp<b>Medida</b><br><br> Sem Medição </label>
                </div>
                } 
                @else
                <div class="col-md-6">
                    <label for="codigo"><i class="material-icons" style="vertical-align:middle;">view_week</i>&nbsp&nbsp<b>Medida</b><br><br>{{$produto->medida}} - {{$unidadeMedida->nome}} </label>
                </div>
                @endif

                <div class="col-md-6">
                    <label for="categoria"><i class="material-icons" style="vertical-align:middle;">category</i>&nbsp&nbsp<b>Categoria</b><br><br>{{$produto->categoria->nome}}</label>   
                </div>   
                    
            </div>

            <hr>
            
            <div class="row">
                <div class="col-md-6">
                    <label for="descricao"><i class="material-icons ficha-icon" style="vertical-align:middle;">event_note</i>&nbsp&nbsp<b>Descrição</b><br><br>{{$produto->descricao}}</label> 
                </div>
                    <div class="col-md-6">
                    <label for="fornecedor"><span><i class="material-icons" style="vertical-align:middle;">account_circle</i></span>&nbsp&nbsp<b>Fornecedor</b><br><br>{{$produto->fornecedor->nome}}</label>

                    </div>
            </div>
            <hr>
            
            
         

        </div>
    </div>
    
    <div class="d-flex justify-content-end mt-3">
    <input type="button" class="btn btn-primary mr-3" value="Imprimir" onclick="window.print()"/>
    <form method="POST" action="{{url('/estoquemadeireira/produtos/' . $produto->id)}}">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger ml-3">Desativar</button>
    </form>
    
    </div>
    
</div>













@endsection