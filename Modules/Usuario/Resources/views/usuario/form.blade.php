@extends('template')
<!-- @section('title', 'Exemplo') -->

@section('content')
<div class="row justify-content-center align-items-center" style="height:100%">
    <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
        <div>
            @if(Session::has('sucesso'))
            <p>{{Session::get('sucesso')}}</p>
            @endif

            @if(Session::has('erro'))
            <p>{{Session::get('erro')}}</p>
            @endif
        </div>
        <h2 class="my-4">Cadastrar Usuário</h1>
        <form method="POST" action="{{ url((isset($usuario) ? ('usuario/'.$usuario->id) : 'usuario') ) }}">
            @if(isset($usuario))
                @method('PUT')
            @endif
                
            @csrf

            <div class="form-group">
                <label for="apelido">Apelido</label>
                <input value="{{old('apelido', isset($usuario) ? $usuario->apelido : '')}}" class="form-control" type="text" name="apelido">
                {{$errors->first('apelido')}}
            </div>
            <div class="form-group">
                <label for="avatar">Avatar</label>
                <input value="{{old('avatar', isset($usuario) ? $usuario->avatar : '')}}" class="form-control" type="text" name="avatar">
                {{$errors->first('avatar')}}
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input value="{{old('email', isset($usuario) ? $usuario->email : '')}}" class="form-control" type="email" name="email">
                {{$errors->first('email')}}
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input class="form-control" type="password" name="password">
                {{$errors->first('password')}}
            </div>
            <div class="form-group">
                <label>Repita a Senha</label>
                <input class="form-control" type="password" name="repeat_password">
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
    </div>
</div>
@endsection