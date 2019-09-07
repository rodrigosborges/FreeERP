@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Estoque')
@section('body')


<form action="{{url($data['url'])}}" method="POST">
    @csrf
    @if(isset($estoque))
    @method('put')
    @endif
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="categoria_id">Produtos</label>
                <select class="custom-select" id="categoriaPai" name="categoriaPai">
                    <option value="-1">Selecione</option>
                    @foreach($data['produtos'] as $produto)
                    <option value="{{$produto->id}}">{{$produto->nome}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group col-4">
            <label for="nome">Quantidade</label>
            <input type="number" name='quantidade' id="quantidade" class="form-control" maxlength="45" value="{{(isset($estoque))?$categoria->nome:''}}">
            <p class=" alert" id="mensagem-nome"> {{$errors->first('quantidade')}}</p>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="categoria_id">Tipo Unidade</label>
                <select class="custom-select" id="tipo_unidade" name="tipoUnidade">
                    <option value="-1">Selecione</option>
                    @foreach($data['tipoUnidade'] as $unidade)
                    <option value="{{$produto->id}}">{{$unidade->nome}}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>


    <div class="row col-12" style="justify-content: flex-start;">
        <button type="submit" id="enviar" class="btn btn-primary">{{$data['button']}}</button>
    </div>

</form>
@endsection