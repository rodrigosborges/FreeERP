@extends('estoquemadeireira::vendas.vendastemplate')

@section('title', 'Pedidos')

@section('body')



    <div class="container col-12" style="justify-content: center">
        <div class="card">
                <div class="card-header" style="">
                   <h1>Atualizar pedido</h1> 
                </div>
                <form action="{{isset($pedido) ?  url('/estoquemadeireira/vendas/pedidos/' . $pedido->id) : url('/estoquemadeireira/vendas/pedidos')}}" method="POST">
            @csrf
            @if(isset($pedido))
                @method('put')
            @endif

                <div class="row ml-2 mt-2">
                    <div class="form-group col-3">
                        <label for="nome">Status</label>
                        <select name="opcao" id="">Status</select>
                        
                        <input required type="text" class="form-control" placeholder="Insira o nome do Cliente" name="nome" value={{$pedido->last()->status_pedido}}>
                        <span style="color:red">{{$errors->first('pedido')}}</span>
                    </div>
                   
                
                    <div class="row col-12 mb-2" style="justify-content: flex-end;">
                        <button type="submit" class="btn btn-primary">{{isset($pedido) ? 'Salvar' : 'Cadastrar' }}</button>
                    </div>
                </div>
        </form>
        </div>
        
     
            

                
        

    </div>       






@endsection
