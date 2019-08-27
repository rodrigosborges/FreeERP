@extends('estoque::template')
@section('title', 'Unidade de Produto')

@section('content')
<form action="{{url('/estoque/produto/unidade')}}" method="POST">
    @csrf
    <div class="container" style="justify-content: center">
        <div class="row">
            <div class="col-5">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input required type="text" name="tipo" class="form-control">
                    {{$errors->first('tipo')}}
                </div>
            </div>
           
            <div class="col-3" style="justify-content: flex-end;">
                <button type="submit" class="btn btn-primary">{{isset($tipo) ? 'Salvar' : 'Cadastrar'}}</button>
            </div>
        </div>
        </form>  
    </div>  
@endsection