@extends('protocolos::template')

@section('title','Login de Usuário')

@section('body')
<div class="d-flex justify-content-center" style="margin-top:8%">
    <div class="card" style="width:40%">
        <div class="card-body">
            <h1 style="text-align:center">FreeERP</h1>
            <br>
            <br>

            <!-- <p>
                This view is loaded from module: {!! config('usuario.name') !!}
            </p> -->

            <form id="loginForm" method="POST" action="logar">
                        
                    @csrf

                    <div class="form-group">
                        <label for="apelido">Apelido</label>
                        <input required id="apelido" class="form-control" type="text" name="apelido">
                        {{$errors->first('apelido')}}
                        <br>
                        <label for="password">Senha</label>
                        <input required id="password" class="form-control" type="password" name="password">
                        {{$errors->first('password')}}
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">Entrar</button>
                    <br>
                    <br>
            </form>
            <a href="{{url('protocolos/cadastrar')}}">Cadastrar usuário</a>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        $('#loginForm').validate({
            rules:{
                login: {
                    required:true
                },
                password:{
                    required:true
                }
                },
                messages:{
                    login:{
                        required:"<span style='color:red'>Informe o Apelido ou email</span>",
                    },
                password:{
                    required:"<span style='color:red'>Informe a Senha</span>",
                }
            }
        });
    </script>
@endsection