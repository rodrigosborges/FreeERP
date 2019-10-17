@extends('usuario::layouts.informacoes')
<!-- @section('title', 'Exemplo') -->
@section('css')
    <link rel="stylesheet" type="text/css" href="{{Module::asset('usuario:css/usuario/form.css')}}">
@endsection

@section('content')
<div class="row justify-content-center align-items-center" style="height:100%">
    <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
               

                <h2 class="my-2">{{isset($usuario) ? 'Editar' : 'Cadastrar'}} Usuário</h2>
            </div>
            <div class="card-body">
                <form id='usuarioForm' method="POST" enctype = 'multipart/form-data' action="{{ url((isset($usuario) ? ('usuario/'.$usuario->id) : '/usuario') ) }}">
                    @if(isset($usuario))
                        @method('PUT')
                    @endif
                        
                    @csrf

                    <div class="form-group" >
                        @if(isset($usuario))
                        <!-- <div class='text-center'>
                            <img width= 100vw  id='imageAvatar' height = 100vh class='rounded-circle border border-dark mb-3' src="{{asset('storage/img/avatars/'.$usuario->avatar)}}">
                        </div> -->
                        <div class="custom-file">
                            
                            <!-- <label class="custom-file-label" for="avatar">Selecionar imagem</label> -->
                         
                            <div class='text-center overlay-image'>
                    
                                <label for="avatar">
                                    <div id="imagem">
                                    <input hidden value="{{old('avatar', isset($usuario) ? $usuario->avatar : '')}}" type="file" class="custom-file-input form-control" id="avatar" accept="image/jpeg,image/png" lang="pt-br" name="avatar">
                                        <img id='imageAvatar' class='rounded-circle border border-dark' src="{{asset('storage/img/avatars/'.$usuario->avatar)}}">
                                        <i id="hover" class="material-icons">edit</i>
                                    </div>
                                    <!-- <div class="normal">
                                    <div class="text"></div>
                                    </div>
                                    <div class="hover">
                                    <i class="text material-icons">edit</i>
                                    </div> -->
                                </label>
                                
                                
                                
                            
                            </div>
                            
                        
                            {{$errors->first('avatar')}}
                        </div>
                        @endif
                    </div>
                 
                    <div class="form-group mt-5">
                        <label for="apelido">Apelido</label>
                        <input required minlenght='3' id="apelido" maxlenght='50' value="{{old('apelido', isset($usuario) ? $usuario->apelido : '')}}" class="form-control" type="text" name="apelido">
                        {{$errors->first('apelido')}}
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input required id='email' value="{{old('email', isset($usuario) ? $usuario->email : '')}}" class="form-control" type="email" name="email">
                        {{$errors->first('email')}}
                    </div>

                    @if(!isset($usuario))
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input id='password' required class="form-control" type="password" name="password">
                        {{$errors->first('password')}}
                    </div>
                    <div class="form-group">
                        <label>Confirmar Senha</label>
                        <input required class="form-control" type="password" name="repeat_password">
                    </div>

                           
                    <div class="form-group input-modulo-papel">
                    <div class="form-row input-modulo-papel-interior">
                            <div class="col-md-5 mb-1">
                                <label for='modulo'>Modulo</label>
                                <select class="form-control" name='modulo[][modulo_id]'>
                                    <option disabled selected>Escolha um Modulo...</option>
                                    @foreach($modulos as $modulo)
                                    <option value="{{ $modulo->id }}" > {{ $modulo->nome }} </option>
                                    @endforeach
                                </select>
                            </div>
                            
                        <div class="col-md-5 mb-1">
                                <label for="papel">Papel</label>
                                <select class="form-control" name='papel[][papel_id]'>
                                    <option disabled selected>Escolha um Papel...</option>
                                    @foreach($papeis as $papel)
                                    <option value="{{ $papel->id }}" {{isset($usuario) && $papel->id == $usuario->papel_id ? 'selected' : '' }}> {{ $papel->nome }} </option>
                                    @endforeach
                                </select>
                                {{$errors->first('papel')}}
                            </div>
                            <div class="col-md-1" style="margin-top:32px;">
                                <a  class='btn bg-success adicionar text-white'>+</a>
                                </div>
                        </div>
                    </div>
                    @endif
                    <div class="d-flex justify-content-between mb-3">
                        <button type="submit" class="btn btn-success d-flex align-items-center">
                            <i class="material-icons mr-2">save</i>Salvar
                        </button>
                </form>
                        <a class="btn btn-secondary d-flex align-items-center" href="/usuario">
                            <i class="material-icons mr-2">view_list</i> Usuários Cadastrados
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@section('js')
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>


<script>

var apelido = $("#apelido").text()

var usuario_id = "{{isset($usuario) ? $usuario->id : ''}}"

function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imageAvatar').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#avatar").change(function(){
        readURL(this);
    });

</script>

<script>
        $(document).ready(function(){
            $(".adicionar").click(function(){
                //div que irá ser clonada
                var div = $(".input-modulo-papel").first().clone(true)
            
                div.insertAfter($(".form-group").last())
                var div2 = $(".input-modulo-papel-interior").last()
                div2.append("<div class='col-md-1' style='margin-top:32px';><a  class='btn bg-danger text-white remover'>-</a></div>");
            });
            $(document).on("click", '.remover', function(){
                    $(this).parent().parent().remove();
            })
        })
    </script>

<script src="{{Module::asset('usuario:js/usuario/validacao-form.js')}}"></script>
@endsection


@endsection