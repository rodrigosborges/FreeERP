@extends('usuario::layouts.informacoes')
<!-- @section('title', 'Exemplo') -->

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
                        <div class='text-center'>
                            <img width= 100vw height = 100vh class='rounded-circle border border-dark mb-3' src="{{asset('storage/img/avatars/'.$usuario->avatar)}}">
                        </div>
                        @endif
                        <label for="apelido">Apelido</label>
                        <input required minlenght='3' id="apelido" maxlenght='50' value="{{old('apelido', isset($usuario) ? $usuario->apelido : '')}}" class="form-control" type="text" name="apelido">
                        {{$errors->first('apelido')}}
                    </div>
                    <div class="form-group">
                        <label for="avatar">Avatar</label>

                        <div class="custom-file">
                            <input value="{{old('avatar', isset($usuario) ? $usuario->avatar : '')}}" type="file" class="custom-file-input form-control" id="avatar" accept="image/jpeg,image/png" lang="pt-br" name="avatar">
                            <label class="custom-file-label" for="avatar">Selecionar imagem</label>
                        
                            {{$errors->first('avatar')}}
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input required id='email' value="{{old('email', isset($usuario) ? $usuario->email : '')}}" class="form-control" type="email" name="email">
                        {{$errors->first('email')}}
                    </div>
                    
                    <div class="form-group">
                        <label for="papel">Papel</label>
                        <select class="form-control" name='papel'>
                            <option disabled selected>Escolha um Papel...</option>
                            @foreach($papeis as $papel)
                            <option value="{{ $papel->id }}" {{isset($usuario) && $papel->id == $usuario->papel_id ? 'selected' : '' }}> {{ $papel->nome }} </option>
                            @endforeach
                        </select>
                        {{$errors->first('papel')}}
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
                    @endif
                
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                
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

</script>

<script src="{{Module::asset('usuario:js/usuario/validacao-form.js')}}"></script>
@endsection


@endsection