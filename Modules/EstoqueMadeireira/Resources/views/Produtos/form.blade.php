@extends('estoquemadeireira::layouts.master')

@section('title', 'Cadastro de Produtos')

@section('content')



    <div class="container col-12" style="justify-content: center">
        <div class="card">
                <div class="card-header" style="">
                    Cadastro de Produtos
                </div>
        </div>
        <form action="{{isset($produto) ?  url('/estoquemadeireira/produtos/' . $produto->id) : url('/estoquemadeireira/produtos')}}" method="POST">
            @csrf
            @if(isset($produto))
                @method('put')
            @endif

            <div class="row">
                <div class="form-group col-4">
                    <label for="nome">Nome</label>
                    <input required type="text" class="form-control" placeholder="Insira o nome do Produto" name="nome" value="{{isset($produto) ? $produto->nome : ''}}">
                    <span style="color:red">{{$errors->first('nome')}}</span>
                </div>

                <div class="form-group col-4">
                    <label for="preco">Preço</label>
                    <input required type="text" class="form-control" placeholder="R$" name="preco"  onKeyUp="verificaPreco(this);" value="{{isset($produto) ? $produto->preco : ''}}">
                    {{$errors->first('preco')}}
                </div>
            </div>
           
           <div class="row">
                <div class="form-group col-4">
                    <label for="codigo">Código de Barras</label>
                    <input required type="number" class="form-control" placeholder="Insira o código do Produto" name="codigo" value="{{isset($produto) ? $produto->codigo : ''}}">
                    {{$errors->first('codigo')}}
                </div>

                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select name="form-control" id="categoria_id">
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

            

                
        </form>

    </div>       




@endsection
<script>
    function verificaPreco(i){
        var v = i.value.replace(/\D/g,'');
        v = (v/100).toFixed(2) + '';
        v = v.replace(",", ".");
        v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1$2$3.");
        v = v.replace(/(\d)(\d{3}),/g, "$1$2.");
        i.value = v;
    
    }
</script>