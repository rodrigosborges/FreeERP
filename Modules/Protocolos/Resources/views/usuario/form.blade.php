@extends('protocolos::layouts.informacoes')

@section('title', 'Usuário')

@section('body')        
    <form id="form-usuario" action="{{ $data['url'] }}" method="POST" enctype="form-data">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif
                 
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

        <div class="form-group">
            <label for="nome" class="control-label">Setor de Criação: <span class="required-symbol">*</span></label>
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
            <label for="password">Senha</label>
                <input id='password' required class="form-control" type="password" name="password">
                {{$errors->first('password')}}
            </div>

            <div class="form-group">
                <label>Confirmar Senha</label>
                <input required class="form-control" type="password" name="repeat_password">
            </div>
        @endif
    </form>      
@endsection

@section('footer')
    <div class="text-right">
        <button class="btn btn-success sendForm" type="button">{{$data['button']}}</button>
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

<!-- <script src="{{Module::asset('usuario:js/usuario/validacao-form.js')}}"></script> -->
@endsection


