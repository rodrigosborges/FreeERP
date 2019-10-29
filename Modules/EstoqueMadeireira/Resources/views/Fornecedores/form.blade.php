@extends('estoquemadeireira::layouts.master')

@section('title', 'Cadastro de Fornecedor')

@section('content')



    <div class="container col-10" style="justify-content: center">
        <div class="card">
                <div class="card-header" style="">
                   <h1>Cadastro de Fornecedor</h1> 
                </div>
                <form action="{{isset($fornecedor) ?  url('/estoquemadeireira/produtos/fornecedores' . $fornecedor->id) : url('/estoquemadeireira/produtos/fornecedores')}}" method="POST">
                    @csrf
                    @if(isset($fornecedor))
                        @method('put')
                    @endif
            
                        <div class="row mt-2 ml-2">
                            <div class="form-group col-4">
                                <label for="nome">Nome</label>
                                <input required type="text" class="form-control" placeholder="Insira o nome do Fornecedor" name="nome" value="{{isset($fornecedor) ? $fornecedor->nome : ''}}">
                                <span style="color:red">{{$errors->first('nome')}}</span>
                            </div>
                    
                            <div class="form-group col-4">
                                <label for="endereco">Endereço</label>
                                <input required type="text" class="form-control" placeholder="Insira o endereço do Fornecedor" name="endereco" value="{{isset($fornecedor) ? $fornecedor->endereco : ''}}">
                                <span style="color:red">{{$errors->first('endereco')}}</span>
                            </div>               
                        </div>

                        <div class="row mt-2 ml-2">
                            <div class="form-group col-4">
                                <label for="cnpj">CNPJ</label>
                                <input type="text" class="form-control" placeholder="Insira o CNPJ" name="cnpj" value="{{isset($fornecedor) ? $fornecedor->cnpj : ''}}">
                                <span style="color:red">{{$errors->first('cnpj')}}</span>
                            </div>
                        
                        </div>
                    
                        <div class="row col-8 mb-2" style="justify-content: flex-end;">
                            <button type="submit" class="btn btn-primary">{{isset($categoria) ? 'Salvar' : 'Cadastrar' }}</button>
                        </div>
                
                </form>
        
        </div>
        
     
    </div>       




@endsection