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
        <h3>Cadastrar técnico</h3>
    </div>
    <div class="card-body">
        <div class="row ">
            <div class="col-md-11 text-left">
                <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
                <a href="{{route('tecnico.localizar')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
            </div>
        </div>
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