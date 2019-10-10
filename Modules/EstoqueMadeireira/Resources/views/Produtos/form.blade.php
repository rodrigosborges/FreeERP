@extends('estoquemadeireira::layouts.master')

@section('title', 'Cadastro de Produtos')

@section('content')



    <div class="container col-12" style="justify-content: center">
        <div class="card">
                <div class="card-header" style="">
                   <h1>Cadastro de Produtos</h1> 
                </div>
        
        <form action="{{isset($produto) ?  url('/estoquemadeireira/produtos/' . $produto->id) : url('/estoquemadeireira/produtos')}}" method="POST">
            @csrf
            @if(isset($produto))
                @method('put')
            @endif

                <div class="row ml-2 mt-2">
                    <div class="form-group col-4">
                        <label for="nome">Nome</label>
                        <input required type="text" class="form-control" placeholder="Insira o nome do Produto" name="nome" value="{{isset($produto) ? $produto->nome : ''}}">
                        <span style="color:red">{{$errors->first('nome')}}</span>
                    </div>

                    <div class="form-group col-3">
                        <label for="preco">Preço</label>
                        <input required type="text" class="form-control" placeholder="R$" name="preco"  onKeyUp="verificaPreco(this);" value="{{isset($produto) ? $produto->preco : ''}}">
                        {{$errors->first('preco')}}
                    </div>
                </div>
            
            <div class="row ml-2 mt-2">
                    <div class="form-group col-3">
                        <label for="codigo">Código de Barras</label>
                        <input required type="number" class="form-control" placeholder="Insira o código do Produto" name="codigo" value="{{isset($produto) ? $produto->codigo : ''}}">
                        {{$errors->first('codigo')}}
                    </div>
    
                    <div class="form-group ml-2">
                        <label for="categoria">Categoria</label>
                        <select class="form-control" name="categoria_id">
                            @if(isset($produto))
                                @foreach($categorias as $categoria)
                                    @if($categoria->id == $produto->categoria_id)
                                        <option value="{{$categoria->id}}" selected>{{$categoria->nome}}</option>
                                    @else
                                        <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                    @endif
                                @endforeach
                            @else
                                <option disabled value="" selected>Selecione uma Categoria</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                    @endforeach
                            @endif
                        </select>
                        {{$errors->first('categoria_id')}}            
                    </div>

                    <div class="form-group ml-2">
                        <label for="fornecedor">Fornecedor</label>
                        <select name="fornecedor_id" class="form-control">
                            @if(isset($fornecedor))
                                @foreach($fornecedores as $fornecedor)
                                    @if($fornecedor->id == $produto->fornecedor_id)
                                        <option value="{{$fornecedor->id}}" selected>{{$fornecedor->nome}} </option>
                                    @else
                                        <option value="{{$fornecedor->id}}"> {{$fornecedor->nome}}</option>
                                    @endif
                                @endforeach
                            @else
                                <option disabled value="" selected>Selecione um Fornecedor</option>
                                    @foreach ($fornecedores as $fornecedor)
                                        <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
                                    @endforeach
                            @endif
                        </select>
                        {{$errors->first('fornecedor_id')}}
                    </div>


            </div>
                <div class="form-group ml-2">            
                    <div class="row col-12" style="align-items:flex-start;">
                        <div class="form-group col-12">
                            <label for="descricao">Descrição </label> <br>
                            <textarea class="forma-control" name="descricao" placeholder="Insira a descrição do Produto" rows="4">{{isset($produto) ? $produto->descricao : ''}}</textarea> 
                            {{$errors->first('descricao')}}
                        </div>                                
                    </div>
                </div>
                <div class="row col-8" style="justify-content: flex-end;">
                     <button type="submit" class="btn btn-primary">{{isset($produto) ? 'Salvar' : 'Cadastrar' }}</button>
                </div>
            
            

                
        </form>

    </div>       
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