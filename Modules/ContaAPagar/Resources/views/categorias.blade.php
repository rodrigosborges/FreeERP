@extends('contaapagar::layouts.master')
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
        <a href="{{route('categoria.nova')}}" class="btn btn-primary" id="novo">Nova Categoria</a>
    </div>
</header>    
<br>
        
  
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Excluir</th>

            </tr>
        </thead>
        <tbody>
           @foreach ($categorias as $categoria)
            <tr>
                    <td>{{$categoria->nome}}</td>
                    <td><i class='material-icons'>delete</i></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop