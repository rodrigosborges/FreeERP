@extends('template')
@section('title','Categorias')
@section('content')
<div class="row justify-content-center">
<div class="card col-sm-8">
  <div class="card-header ">
<h3 class="card-title text-center">  {{$data['titulo']}}</h3>
  </div>
  <div class="card-body ">
  <div class="">
        <form action="{{url( isset($categoria)?'estoque/produto/categoria/'.$categoria->id:'estoque/produto/categoria' )}}" method="POST">
            @csrf
            @if(isset($categoria))
            @method('PUT')
            @endif  
            <div class="form-group">
                <label for="categoriaPai"> Categoria</label>
                <select class="custom-select" id="categoriaPai" name="categoriaPai">
                    <option value="-1">Selecione</option>
                    @foreach($categorias as $cat)
                    <option value="{{$cat->id}}" {{isset($categoria)&&$subcategoria->categoria_id== $cat->id?'selected':''}}>{{$cat->nome}}</option>
                    @endforeach
                </select>
                <label for="nome">Nome:</label>
                <input type="text" name='nome' id="nome" class="form-control" maxlength="45" value="{{(isset($categoria))?$categoria->nome:''}}">
                <p class='alert-danger'> {{$errors->first('nome')}}</p><br>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-success">{{$data['button']}}
                </button>
            </div>
        </form>
    </div>
  </div>
</div>
</div>
@endsection