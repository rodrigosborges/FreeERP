@extends('estoquemadeireira::layouts.master')

@section('title', 'Cadastro de Fornecedor')

@section('content')



    <div class="container col-12" style="justify-content: center">
        <div class="card">
                <div class="card-header" style="">
                   <h1>Cadastro de Fornecedor</h1> 
                </div>
                <form action="{{isset($fornecedor) ?  url('/estoquemadeireira/produtos/fornecedores' . $fornecedor->id) : url('/estoquemadeireira/produtos/fornecedores')}}" method="POST">
            @csrf
            @if(isset($fornecedor))
                @method('put')
            @endif

                <div class="row ml-2 mt-2">
                    <div class="form-group col-4">
                        <label for="nome">Nome</label>
                        <input required type="text" class="form-control" placeholder="Insira o nome da Categoria" name="nome" value="{{isset($fornecedor) ? $fornecedor->nome : ''}}">
                        <span style="color:red">{{$errors->first('nome')}}</span>
                    </div>

                    
                </div>
               
                <div class="row col-8" style="justify-content: flex-end;">
                     <button type="submit" class="btn btn-primary">{{isset($categoria) ? 'Salvar' : 'Cadastrar' }}</button>
                </div>
                
        </form>
        </div>
        
     
            

                
        

    </div>       




@endsection
