@extends('usuario::layouts.informacoes')

@section('content')
<div class="row justify-content-center align-items-center" style="height:100%">
    <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
        <div>
            @if(Session::has('erro'))
            <p>{{Session::get('erro')}}</p>
            @endif
        </div>
        <h2 class="my-4">Cadastrar Papel</h1>
        <form method="POST" action="{{ url((isset($papel) ? ('papel/'.$papel->id) : 'papel') ) }}">
            @if(isset($papel))
                @method('PUT')
            @endif
                
            @csrf

            <div class="form-group">
                <label for="nome">Nome</label>
                <input value="{{old('nome', isset($papel) ? $papel->nome : '')}}" class="form-control" type="text" name="nome">
                {{$errors->first('nome')}}
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
    </div>
</div>
@endsection