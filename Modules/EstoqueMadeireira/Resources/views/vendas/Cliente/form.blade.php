@extends('estoquemadeireira::layouts.master')

@section('title', 'Cadastro de Cliente')

@section('content')



    <div class="container col-12" style="justify-content: center">
        <div class="card">
                <div class="card-header" style="">
                   <h1>Cadastro de Cliente</h1> 
                </div>
                <form action="{{isset($cliente) ?  url('/estoquemadeireira/vendas/cliente/' . $cliente->id) : url('/estoquemadeireira/vendas/cliente')}}" method="POST">
            @csrf
            @if(isset($cliente))
                @method('put')
            @endif

                <div class="row ml-2 mt-2">
                    <div class="form-group col-4">
                        <label for="nome">Nome</label>
                        <input required type="text" class="form-control" placeholder="Insira o nome do Cliente" name="nome" value="{{($data['tipo'])?$data['tipo']->nome : ''}}">
                        <span style="color:red">{{$errors->first('nome')}}</span>
                    </div>
                    <div class="form-group col-4">
                        <label for="nome">Telefone</label>
                        <input required type="text" class="form-control" placeholder="Insira o telefone" name="nome" value="{{isset($cliente) ? $cliente->telefone : ''}}">
                        <span style="color:red">{{$errors->first('telefone')}}</span>
                    </div>

                    
                </div>
               
                <div class="row col-12 mb-2" style="justify-content: flex-end;">
                     <button type="submit" class="btn btn-primary">{{isset($cliente) ? 'Salvar' : 'Cadastrar' }}</button>
                </div>
                
        </form>
        </div>
        
     
            

                
        

    </div>       






@endsection