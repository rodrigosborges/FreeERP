@extends('estoquemadeireira::layouts.master')

@section('title', 'Estoque Madeireira')

@section('content')

<div class="container">
    <div class="table text-center">
        <div class="card">
            <div class="card-header text-left">
                <h4>Estoque</h4>
            </div>       
    
        <form action="{{url('/estoquemadeireira/buscar')}}" method="POST" id="formulario">
            @csrf
            <div class="row ml-2 mt-2">
                <div class="form-group col-10">
                    <input type="text" id="search-input" placeholder="Insira o nome produto" name="pesquisa" class="form-control">
                </div>

                <div class="form-group col-1">
                    <button type="submit" class="btn btn-sm btn-secondary" style="font-size:18px;"><i class="btn btn-sm btn-secondary material-icons" style="font-size:18px;" id="search-button">search</i></button>
                </div>
            </div>
        </form>
        

    </div>
    
    <thead class="">
        <div class="col-12 text-right mt-3 mb-2">
            <a class="btn btn-success btn-sm mr-2"  href="{{url('/estoquemadeireira/create')}}">
            <i class="material-icons" style="vertical-align:middle; font-size:25px;">note_add</i>Adicionar
            </a>
            <a class="btn btn-danger btn-sm" href="{{url('/estoquemadeireira/inativos')}}">
            <i class="material-icons" style="vertical-align:middle; font-size:25px;">delete</i>Inativos
            </a>
        </div>
        
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Categoria</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
    
        
        </tr>
    
    
    
    </thead>
    
    
    </div>








</div>


@endsection