@extends('protocolos::template')

@section('title', 'Cadastrar usuário')

@section('body')        
    <form id="form-usuario" action="{{ $data['url'] }}" class="registerForm" method="POST" enctype="form-data">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif

        <div class="form-group mt-5">
            <label for="nome">Nome completo:<span class="required-symbol">*</span></label>
                <input required minlenght='3' id="nome" maxlenght='50' value="{{old('nome', isset($usuario) ? $usuario->nome : '')}}" class="form-control" type="text" name="nome">
                <small id="error" class="errors font-text text-danger">{{$errors->first('nome')}}</small>
        </div>

        <div class="form-group">
            <label for="apelido">Apelido:<span class="required-symbol">*</span></label>
            <input required minlenght='3' id="apelido" maxlenght='50' value="{{old('apelido', isset($usuario) ? $usuario->apelido : '')}}" class="form-control" type="text" name="apelido">
            <small id="error" class="errors font-text text-danger">{{$errors->first('apelido')}}</small>
        </div>

        <div class="form-group">
            <label for="email">E-mail:<span class="required-symbol">*</span></label>
            <input required id='email' value="{{old('email', isset($usuario) ? $usuario->email : '')}}" class="form-control" type="email" name="email">
            <small id="error" class="errors font-text text-danger">{{$errors->first('email')}}</small>
        </div>

        <div class="form-group">
            <label for="nome" class="control-label">Setor do usuário: <span class="required-symbol">*</span></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">business</i>
                    </span>
                </div>
                <select required name="usuario[setor_id]" class="form-control">
                    <option value="">Selecione</option>
                    @foreach($data['setor'] as $item)
                        <option value="{{ $item->id }}" {{ old('setor.setor_id', $data['model']? $data['model']->setor()->id : '') == $item->id ? 'selected' : '' }}> {{ $item->nome }} </option>
                    @endforeach
                </select>
            </div>
        </div>

        @if(!isset($usuario))
            <div class="form-group">
            <label for="password">Senha:<span class="required-symbol">*</span></label>
                <input id='password' required class="form-control" type="password" name="password">
                <small id="error" class="errors font-text text-danger">{{$errors->first('password')}}</small>
            </div>

            <div class="form-group">
                <label>Confirmar Senha:<span class="required-symbol">*</span></label>
                <input required class="form-control" type="password" name="repeat_password">
            </div>
        @endif
    </form>      
@endsection

@section('footer')
    <div class="text-right">
        <button class="btn btn-success sendForm" type="button">
            <i class="material-icons lock-locked" style="vertical-align:middle; font-size:25px; margin-right:5px;">save</i>{{$data['button']}}
        </button>
    </div>
@endsection

@section('script')
<script type = "text/javascript">
var apelido = $("#apelido").text()
var usuario_id = "{{isset($usuario) ? $usuario->id : ''}}"
    $(document).ready(function(){
        $(".sendForm").on('click',function(){
            $(".sendForm").prop("disabled",true) 
            $("#form-usuario").submit()  
            console.log('success')
        })
    });
</script>
@endsection


