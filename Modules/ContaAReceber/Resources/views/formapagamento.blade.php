@extends('contaareceber::layouts.master')
@section('css')
    <style>
        .teste {
            display: flex;
            justify-content: flex-end;
            margin-right: 1px;
        }
        
        #novo {
            margin-right: 2.5px;
        }
        
        #dropdownMenuButton{
            margin-left: 2.5px;
        }
        
        .check {
            display: flex;
            justify-content: flex-end;
            margin-right: 1px;
        }
        
    </style>
@stop
@section('content')
    <h1>Categorias</h1>
    
<header>        
    <div class="row teste">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Nova forma de pagamento
        </button>
    </div>
</header>    
<br>
        
  
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Taxa (%)</th>
                <th scope="col">Prazo de Recebimento (dias)</th>
                <th scope="col">Excluir</th>

            </tr>
        </thead>
        <tbody>
           @foreach ($formapgs as $formapg)
            <tr>
                    <td>{{$formapg->nome}}</td>
                    <td>{{$formapg->taxa}}</td>
                    <td>{{$formapg->prazo_recebimento}}</td>
                    <td><a href="{{Route('forma_pagamento.deletar', $formapg->id)}}"><i class='material-icons'>delete</i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Nova forma de pagamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form action="{{route('forma_pagamento.salvar')}}" method="post">
                    {{ csrf_field() }}
                    <div class="col-12">
                        @include('contaareceber::_formformapg')
                    </div>
                    <div class="col-12 text-center"> 
                        <button class="btn btn-primary">Salvar forma de pagamento</button>
                    </div>
                    
                </form>
                
            </div>

        </div>
    </div>
</div>
@stop