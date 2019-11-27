@extends('usuario::layouts.informacoes')


@section('content')
<div class="row justify-content-center align-items-center" style="height:100%">
    <div class="col-xm-12 col-sm-10 col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    @if(!isset($papel))
                        Cadastrar Papel
                    @else
                        Alterar Papel
                    @endif
                </h5>
            </div>
            <div>
                <form id="papelForm" class="card-body d-flex flex-column" method="post" action="{{ url(isset($papel) ? 'papel/'.$papel->id : 'papel') }}">
                    @if(isset($papel))
                        @method('PUT')
                    @endif
                    @csrf

                    <div class="form-group">
                        <input value="{{ old('nome', isset($papel) ? $papel->nome : '') }}" class="form-control" type="text" name="nome" placeholder="Nome do Papel">
                        {{$errors->first('nome')}}
                    </div>
                    <!-- <div class="form-group">
                        <input value="{{ old('icone', isset($papel) ? $papel->icone : '') }}" class="form-control" type="text" name="icone" placeholder="Ícone do Papel">
                    </div> -->
                    <div class="d-flex justify-content-between mb-3">
                        <button type="submit" class="btn btn-success d-flex align-items-center">
                            <i class="material-icons mr-2">save</i>Salvar
                        </button>
                </form>
                        <a class="btn btn-secondary d-flex align-items-center" href="{{url('/papel')}}">
                            <i class="material-icons mr-2">view_list</i> Papéis Cadastrados
                        </a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script src="{{asset('js/jquery.validate.min.js')}}"></script>


<script src="{{Module::asset('usuario:js/usuario/validacao-form.js')}}"></script>
@endsection