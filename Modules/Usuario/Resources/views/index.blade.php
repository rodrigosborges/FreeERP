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

            <form id="loginForm" method="POST" action="/logar">
                        
                    @csrf

                    <div class="form-group">
                        <label for="apelido">Apelido</label>
                        <input id="apelido" class="form-control" type="text" name="apelido">
                        <br>
                        <label for="password">Senha</label>
                        <input id="password" class="form-control" type="password" name="password">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">Entrar</button>
                    <br>
                    <br>
                </form>
        </div>
    </div>
</div>
@stop
