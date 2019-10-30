@extends('estoquemadeireira::layouts.master')
@section('title', 'Ficha de Fornecedor')
@section('content')

<div class="container" style="justify-content: center" id="imprimir">
    <div class="card">
        <div class="card-header">
            Ficha do Fornecedor
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <label for="nome"><span><i class="material-icons" style="vertical-align:middle;">assignment_turned_in</i></span>&nbsp&nbsp<b>Fornecedor</b><br><br>{{$fornecedor->nome}}</label>
                    
                </div>
                <div class="col-md-6">
                    <label for="endereco"><i class="material-icons" style="vertical-align:middle;">attach_money</i>&nbsp&nbsp<b>Endereço</b><br><br>{{$fornecedor->endereco}}</label>
                </div>

                
            </div>
            <hr>
            
            <div class="row">

                <div class="col-md-6">
                    <label for="cnpj"><i class="material-icons" style="vertical-align:middle;">view_week</i>&nbsp&nbsp<b>CNPJ</b><br><br>{{$fornecedor->cnpj}}</label>
                </div>

                <div class="col-md-6">
                    <label for="telefone"><i class="material-icons" style="vertical-align:middle;">category</i>&nbsp&nbsp<b>telefone</b><br><br>{{$fornecedor->telefone}}</label>   
                </div>   
                    
            </div>

            <hr>
            
            
            
            
         

        </div>
    </div>
    
    <div class="d-flex justify-content-end mt-3">
    <input type="button" class="btn btn-primary mr-3" value="Imprimir" onclick="window.print()"/>
    <form method="POST" action="{{url('/estoquemadeireira/produtos/fornecedores' . $fornecedor->id)}}">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger ml-3">Desativar</button>
    </form>
    
    </div>
    
</div>













@endsection