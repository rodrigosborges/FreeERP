@extends('usuario::layouts.login')

@section('content')
<div class="row justify-content-center" style="height:100%">
    <div class="col-xm-10 col-sm-8 col-md-6 col-lg-6">
        <div class='card'>
            <div class='card-header'><h4 class="my-2">Recuperar Senha</h4></div>
                <div class="card-body">
                    <form id="loginForm"  method="POST" action="{{ url( '/recuperarSenha') }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" value="{{$token}}" name="token">
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input class="form-control" type="password" name="password" id="password">
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
    <div class="col-xm-10 col-sm-8 col-md-4 col-lg-4">
        <div class='card'>
            <div class='card-header'><h4 class="my-2">Sua senha deve conter pelo menos...</h4></div>
            <div class='card-body'>
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row" id="length-check">
                        <i class="material-icons mr-2">check_circle_outline</i>
                        <p> 8 a 16 digitos</p>
                    </div>
                    <div class="d-flex flex-row" id="num-check">
                        <i class="material-icons mr-2">check_circle_outline</i>
                        <p> 1 número</p>
                    </div>
                    <div class="d-flex flex-row" id="lower-check">
                        <i class="material-icons mr-2">check_circle_outline</i>
                        <p> 1 letra minúscula</p>
                    </div>
                    <div class="d-flex flex-row" id="upper-check">
                        <i class="material-icons mr-2">check_circle_outline</i>
                        <p> 1 letra maiúscula</p>
                    </div>
                    <div class="d-flex flex-row" id="special-check">
                        <i class="material-icons mr-2">check_circle_outline</i>
                        <p> 1 caractere especial</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{Module::asset('usuario:js/recuperar/validacao-form.js')}}"></script>
<script src="{{Module::asset('usuario:js/usuario/validacao-senha.js')}}"></script>


@endsection
@endsection