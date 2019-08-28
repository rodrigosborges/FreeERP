@extends('estoque::template')
@section('title', 'Unidade de Produto')

@section('content')
<form action="{{isset($unidadeProduto) ? url('/estoque/produto/unidade/' . $unidadeProduto->id) : url('/estoque/produto/unidade')}}" method="POST">
    @csrf

    @if(isset($unidadeProduto))
        @method('PUT')
    @endif
    
    <div class="container" style="justify-content: center">
    <div class="card">
        <div class="card-header">
        Cadastro de Unidade
        </div>
        <div class="card-body">
        <div class="row">
           
                <div class="form-group col-12">
                    <label for="nome">Nome</label>
                    <input required type="text" name="tipo" class="form-control" value="{{isset($unidadeProduto) ? $unidadeProduto->tipo : ''}}">
                    {{$errors->first('tipo')}}
                </div>
          
           
            <div class="row col-12" style="justify-content: flex-end;">
                <button type="submit" class="btn btn-primary">{{isset($unidadeProduto) ? 'Salvar' : 'Cadastrar'}}</button>
            </div>
        </div>
        </form>  
    </div> 
    </div> 
    </div>
@endsection