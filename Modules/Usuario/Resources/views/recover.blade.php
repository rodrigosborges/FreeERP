@extends('usuario::layouts.login')

@section('content')
<div class="row justify-content-center align-items-center" style="height:100%">
    <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
        <div class='card'>
            <div class='card-header'><h2 class="my-2">Recuperar Senha</h1></div>
                <div class="card-body">
                    <form method="POST" action="{{ url( '/recuperarSenha') }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" value="{{$token}}" name="token">
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                    <div class="form-group">
                        <label>Confirmar Senha</label>
                        <input class="form-control" type="password" name="repeat_password">
                    </div>
                    <br>
                    <p style="color: red">{{$errors->first('password')}}</p>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{Module::asset('usuario:js/login/validacao-form.js')}}"></script>
@endsection
@endsection