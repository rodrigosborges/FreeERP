@extends('usuario::layouts.informacoes')
<!-- @section('title', 'Exemplo') -->

@section('content')
<div class="row justify-content-center align-items-center" style="height:100%">
    <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    @if(!isset($modulo))
                        Cadastrar Módulo
                    @else
                        Alterar Módulo
                    @endif
                </h5>
            </div>
            <div>
                <form id="moduloForm" class="card-body d-flex flex-column" method="post" action="{{ url(isset($modulo) ? 'modulo/'.$modulo->id : 'modulo') }}">
                    @if(isset($modulo))
                        @method('PUT')
                    @endif
                    @csrf

                    <div class="form-group">
                        <input value="{{ old('nome', isset($modulo) ? $modulo->nome : '') }}" class="form-control" type="text" name="nome" placeholder="Nome do módulo">
                    </div>
                    <div class="form-group">
                        <input value="{{ old('icone', isset($modulo) ? $modulo->icone : '') }}" class="form-control" type="text" name="icone" placeholder="Ícone do módulo">
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <button type="submit" class="btn btn-success d-flex align-items-center">
                            <i class="material-icons mr-2">save</i>Salvar
                        </button>
                </form>
                        <a class="btn btn-secondary d-flex align-items-center" href="{{url('/modulo')}}">
                            <i class="material-icons mr-2">view_list</i> Módulos Cadastrados
                        </a>
                    </div>
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>
var modulo_id = "{{isset($modulo) ? $modulo->id : ''}}"
</script>
<script src="{{Module::asset('usuario:js/modulo/validacao-form.js')}}"></script>
@endsection

@endsection