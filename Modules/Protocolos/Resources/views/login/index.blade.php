@extends('protocolos::template')

@section('title','FreeERP')

@section('body')
<div class="d-flex justify-content-center">
    <div class="card" style="width:40%">
        <div class="card-body">
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
            </form>
        </div>
    </div>
</div>

@endsection

@section('footer')
    <div class="text-right">
        <button class="btn btn-info sendFormLogin" type="button">
                <i class="material-icons" style="vertical-align:middle; font-size:25px; margin-right:5px;">exit_to_app</i>Logar
        </button>
        <a href="{{url('protocolos/cadastrar')}}">
        <button class="btn btn-success sendForm" type="button">
                <i class="material-icons" style="vertical-align:middle; font-size:25px; margin-right:5px;">add_circle_outline</i>Cadastrar usuário
        </button>
        </a>
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

        $(document).ready(function(){
                $(".sendFormLogin").on('click',function(){
                    $(".sendFormLogin").prop("disabled",true) 
                    $("#loginForm").submit()  
                    console.log('success')
                })
            });
    </script>
@endsection