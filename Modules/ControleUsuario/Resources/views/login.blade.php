@extends('template')
@section('title', 'Login')

@section('content')
    <div class="row justify-content-center align-items-center" style="height:100%">
        <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
            <form>
                <div class="form-group">
                    <label for="inputEmail">Endereço de email</label>
                    <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Seu email">
                </div>
                <div class="form-group">
                    <label for="inputPassword">Senha</label>
                    <input type="password" class="form-control" id="inputPassword" placeholder="Senha">
                </div>
                <p>Esqueci minha senha</p>
                <button type="submit" class="btn btn-primary">Entrar</button>
            </form>    
        </div>
    </div>
@endsection