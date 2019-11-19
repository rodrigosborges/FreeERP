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

                    <label style="font-size:1.08em"><b>Papéis</b></label>
                    <div class="form-group border"  style="height:8em; overflow:auto">
                    <?php $var1 = 0 ?>
                    @foreach($papeis as $papel)
                        <div class="form-check ml-2">
                            <input class="form-check-input" name="papel_id[<?php echo $var1 ?>]" type="checkbox" value="{{ old('papel', isset($papel) ? $papel->id : '') }}" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                            {{$papel->nome}}
                                </label>
                            </div>
                        <?php $var1 = $var1+1 ?>
                        @endforeach
                        </div>
                    <div class="d-flex justify-content-between mb-3">
                        <button type="submit" class="btn btn-success d-flex align-items-center">
                            <i class="material-icons mr-2">save</i>Salvar
                        </button>
                </form>
                        <a class="btn btn-secondary d-flex align-items-center" href="/modulo">
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