@extends('estoquemadeireira::layouts.master')
@section('title', 'Ficha de Cliente')
@section('content')

<div class="container" style="" id="imprimir">
    <div class="card">
        <div class="card-header">
            Ficha do Cliente
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <label for="nome"><span><i class="material-icons" style="vertical-align:middle;">account_circle</i></span>&nbsp&nbsp<b>Cliente</b><br><br>{{$cliente->nome}}</label>
                    
                </div>
                <div class="col-md-6">
                    <label for="endereco"><i class="material-icons" style="vertical-align:middle;">directions</i>&nbsp&nbsp<b>Endereço</b><br><br>{{$cliente->endereco}}</label>
                </div>

                
            </div>
            <hr>
            
            <div class="row">

                <div class="col-md-6">
                    <label for="cnpj"><i class="material-icons" style="vertical-align:middle;">how_to_vote</i>&nbsp&nbsp<b>Documento</b><br><br>{{$cliente->documento}}</label>
                </div>

                <div class="col-md-6">
                    <label for="telefone"><i class="material-icons" style="vertical-align:middle;">phone</i>&nbsp&nbsp<b>Telefone</b><br><br>{{$cliente->tipoDocumento_id}}</label>   
                </div>   
                    
            </div>
            <hr>
           
            <div class="row">
                <div class="col-md-6">
                        <label for="telefone"><i class="material-icons" style="vertical-align:middle;">phone</i>&nbsp&nbsp<b>Telefone</b><br><br>{{$cliente->telefone}}</label>   
                </div> 

                <div class="col-md-6">
                    <label for="cnpj"><i class="material-icons" style="vertical-align:middle;">email</i>&nbsp&nbsp<b>Email</b><br><br>{{$cliente->email}}</label>
                </div>
                
            </div>
            <hr>
            
            
            
        
         

        </div>
    </div>
    
    <div class="d-flex justify-content-end mt-3">
    <input type="button" class="btn btn-primary mr-3" value="Imprimir" onclick="window.print()"/>
    <form method="POST" action="{{url('/estoquemadeireira/vendas/clientes' . $cliente->id)}}">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger ml-3">Desativar</button>
    </form>
    
    </div>
    
</div>













@endsection