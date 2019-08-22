@extends('template')
@section('title','Categorias')
@section('content')
<div class='row justify-content-center'>
    <div class="col-sm-6">
        <form action="{{url( isset($categoria)?'estoque/produto/categoria/'.$categoria->id:'estoque/produto/categoria' )}}" method="POST">
            @csrf
            @if(isset($categoria))

            @method('PUT')
            @endif
            
        <h2 class="text-center">{{$data['titulo']}}</h2>
            <div class="form-group">
                <label for="categoriaPai"> Categoria</label>
                <select class="custom-select" name="categoriaPai">

                    <option value="-1">Selecione</option>
                    @foreach($categorias as $cat)
                    <option value="{{$cat->id}}"  {{isset($categoria)&&$subcategoria->categoria_id== $cat->id?'selected':''}}>{{$cat->nome}}</option>

                    @endforeach
                </select>

                <label for="nome">Nome:</label>

                <input type="text" name='nome' class="form-control" maxlength="45" value="{{(isset($categoria))?$categoria->nome:''}}">
                <p class='alert-danger'> {{$errors->first('nome')}}</p><br>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-success">{{$data['button']}}
                </button>
            </div>
        </form>
    </div>

</div>
@endsection