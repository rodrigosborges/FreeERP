@extends('estoque::template')
@section('title', 'Unidade de Produto')

@section('content')
<form action="{{isset($unidadeProduto) ? url('/estoque/produto/unidade/' . $unidadeProduto->id) : url('/estoque/produto/unidade')}}" method="POST">
    @csrf

    @if(isset($unidadeProduto))
        @method('PUT')
    @endif
    
    <div class="container" style="justify-content: center">
        <div class="row">
            <div class="col-5">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input required type="text" name="tipo" class="form-control" value="{{isset($unidadeProduto) ? $unidadeProduto->tipo : ''}}">
                    {{$errors->first('tipo')}}
                </div>
            </div>
           
            <div class="col-3" style="justify-content: flex-end;">
                <button type="submit" class="btn btn-primary">{{isset($unidadeProduto) ? 'Salvar' : 'Cadastrar'}}</button>
            </div>
        </div>
        </form>  
    </div>  
@endsection