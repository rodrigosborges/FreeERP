@extends('estoquemadeireira::layouts.master')

@section('title', 'Cadastro de Nome de Unidade')

@section('content')



    <div class="container col-12" style="justify-content: center">
        <div class="card">
                <div class="card-header" style="">
                   <h1>Cadastro de Nome de Unidade</h1> 
                </div>
                <form action="{{url($data['url'])}}" method="POST">

            @csrf
            @if(isset($data['tipo']))
                @method('put')
            @endif

                <div class="row ml-2 mt-2">
                    <div class="form-group col-4">
                        <label for="nome">Nome</label>
                        <input required type="text" class="form-control" placeholder="ex: Baia, Box" name="nome" value="{{($data['tipo'])?$data['tipo']->nome : ''}}">
                        <span style="color:red">{{$errors->first('nome')}}</span>
                    </div>
                  
                    
                </div>
               
                <div class="row col-12 mb-2" style="justify-content: flex-end;">
                     <button type="submit" class="btn btn-primary">{{$data['button']}}</button>
                </div>
                
        </form>
        </div>
        
     
            

                
        

    </div>       




@endsection

