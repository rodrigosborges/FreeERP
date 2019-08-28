@extends('template')
@section('title','Categorias')
@section('content')
<div class="container" style="justify-content: center">
<div class="card " >
        <div class="card-header">
       
       {{$data['titulo']}}
        </div>
        <div class="card-body">
        <form action="{{url( isset($categoria)?'estoque/produto/categoria/'.$categoria->id:'estoque/produto/categoria' )}}" method="POST">
        @csrf
        @if(isset($categoria))
            @method('put')
        @endif
        <div class="row">
        <div class="col-4">
                <div class="form-group">
                    <label for="categoria_id">Categoria</label>
                    <select class="custom-select" id="categoriaPai" name="categoriaPai">
                    <option value="-1">Selecione</option>
                    @foreach($categorias as $cat)
                    <option value="{{$cat->id}}" {{isset($categoria)&&$subcategoria->categoria_id== $cat->id?'selected':''}}>{{$cat->nome}}</option>
                    @endforeach
                </select>
                
                   
                    {{$errors->first('categoria_id')}}
                </div>
            </div>
       
                <div class="form-group col-8">
                    <label for="nome">Nome</label>
                    <input type="text" name='nome' id="nome" class="form-control" maxlength="45" value="{{(isset($categoria))?$categoria->nome:''}}">
                    <p class=" alert-warning">  {{$errors->first('nome')}}</p>
                </div>
                </div>
              
            <div class="row col-12" style="justify-content: flex-end;">
                <button type="submit" class="btn btn-primary">{{$data['button']}}</button>
            </div>

        </form>  
        </div>
        </div>
        </div>
@endsection