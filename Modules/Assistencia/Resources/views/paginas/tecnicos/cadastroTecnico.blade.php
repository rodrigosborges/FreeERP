@extends('assistencia::layouts.master')


@section('css')
<style>
.errors {
    color: red;
    font-size: 12px;
    text-align: left;

}
</style>

@stop

@section('content')

<div class="card text-center">
    <div class="card-header">
        <div class="row d-flex text-center justify-content-between align-items-center">
            <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
            <h4>Novo técnico</h4>
            <a href="{{url('/assistencia/tecnico')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
        </div>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <form class="col-md-8" action="{{route('tecnico.salvar')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div>
                    @include('assistencia::paginas.tecnicos._form')
                </div>
                <button class="btn btn-success">Cadastrar</button>
            </form>
        </div>
    </div>
</div>

@stop
@section('js')
<script>
$(document).ready(function() {

    $('.cpf-mask').mask("000.000.000-00")

})
</script>
@stop