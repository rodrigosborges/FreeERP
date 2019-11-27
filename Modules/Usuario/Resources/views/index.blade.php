@extends('usuario::layouts.login')

@section('content')
<div class="d-flex justify-content-center" style="margin-top:8%">
    <div class="card" style="width:40%">
        <div class="card-body">
            <h1 style="text-align:center">FreeErp</h1>
            <br>
            <br>

            <!-- <p>
                This view is loaded from module: {!! config('usuario.name') !!}
            </p> -->

            <form id="loginForm" method="POST" action="{{url('/logar')}}">
                        
                    @csrf

                    <div class="form-group">
                        <label for="login">Apelido ou email</label>
                        <input required id="login" class="form-control" type="text" name="login">
                        {{$errors->first('login')}}
                        <br>
                        <label for="password">Senha</label>
                        <input required id="password" class="form-control" type="password" name="password">
                        {{$errors->first('password')}}
                        <br>
                        <label for="password"><a href="{{url('/esqueciSenha')}}">Esqueci a senha</a></label>
                    </div>
                    <button type="submit" class="btn btn-success">Entrar</button>
                    <br>
                    <br>
                </form>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{Module::asset('usuario:js/login/validacao-form.js')}}"></script>
@endsection
@endsection