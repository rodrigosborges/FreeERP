@extends('estoque::estoque.estoqueTemplate')
@section('title', $data['titulo'])
@section('body')
<form action="{{url($data['url'])}}" method="POST">
    @csrf
    @if(isset($data['tipo']))
        @method('PUT')
    @endif
    <div class="row">
        <div class="form-group col-6">
            <label for="nome">Nome</label>
            <input type="text" name='nome' id="nome" class="form-control" maxlength="45" value="{{($data['tipo'])?$data['tipo']->nome : ''}}"  placeholder="ex: (Caixa, container, unidade)"> 
            <p class=" alert-warning">{{$errors->first('nome')}} </p>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="categoria_id">quantidade de itens</label>
                <input type="number" name="quantidade_itens" class="form-control" value="{{($data['tipo'])?$data['tipo']->quantidade_itens : ''}}">
                <p class="alert-warning">{{$errors->first('quantidade_itens')}}</p>
            </div>
        </div>
    </div>

    <div class="col-2  ">
        <button type="submit" id="enviar" class="btn btn-primary">{{$data['button']}}</button>
    </div>
</form>


@endsection