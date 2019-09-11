@extends('estoque::template')
@section('title', 'Cadastro de Produto')

@section('content')

    
    <div class="container" style="justify-content: center">
    <div class="card">
        <div class="card-header">
        Cadastro de Produto
        </div>
        <div class="card-body">
        <form action="{{isset($produto) ?  url('/estoque/produto/' . $produto->id) : url('/estoque/produto')}}" method="POST">
        @csrf
        @if(isset($produto))
            @method('put')
        @endif
        <div class="row">
                <div class="form-group col-12">
                    <label for="nome">Nome</label>
                    <input required type="text" placeholder="Insira o nome do produto" name="nome" class="form-control" value="{{isset($produto) ? $produto->nome : ''}}">
                    <span style="color:red">{{$errors->first('nome')}}</span>
                </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="preco">Preço de Venda</label>
                    <input type="text" name="preco" placeholder="R$" onkeyUp="moeda(this);" class="form-control" value="{{isset($produto) ? $produto->preco : ''}}" required>
                    {{$errors->first('preco')}}
                </div>
            </div>
            
            <div class="form-group col-4">
                    <label for="codigo">Código de Barras</label>
                    <input required type="number" placeholder="Insira o codigo de barras" name="codigo" class="form-control" value="{{isset($produto) ? $produto->codigo : ''}}">
                    {{$errors->first('codigo')}}
                </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="categoria_id">Categoria</label>
                    <select required class="form-control" name="categoria_id">
                        @if(isset($produto))
                            @foreach($categorias as $categoria)
                                @if($categoria->id == $produto->categoria_id)
                                    <option value="{{$categoria->id}}" selected>{{$categoria->nome}}</option>
                                @else
                                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                @endif
                            @endforeach
                        @else
                            <option disabled value="" selected>Selecione uma categoria</option>
                            @foreach($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                            @endforeach
                        @endif
                    </select>
                    {{$errors->first('categoria_id')}}
                </div>
            </div>
        </div>
            <div class="row" style="align-items: flex-start;">
                <div class="form-group col-12">
                    <label for="descricao">Descrição</label>
                    <textarea class="form-control" placeholder="Insira a descrição do produto" name="descricao" rows="3" required>{{isset($produto) ? $produto->descricao : ''}}</textarea>
                    {{$errors->first('descricao')}}
                </div>
            </div>
            <div class="row col-12" style="justify-content: flex-end;">
                <button type="submit" class="btn btn-primary">{{isset($produto) ? 'Salvar' : 'Cadastrar'}}</button>
            </div>

        </form>  
        </div>
    </div>
    </div>  

@endsection
<script>
    function moeda(i) {
        var v = i.value.replace(/\D/g,'');
        v = (v/100).toFixed(2) + '';
        v = v.replace(",", ".");
        v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1$2$3.");
        v = v.replace(/(\d)(\d{3}),/g, "$1$2.");
        i.value = v;
    }
    </script>