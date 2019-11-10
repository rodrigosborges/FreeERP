@extends('assistencia::layouts.master')


@section('css')


@stop

@section('content')
<div class="card text-center">
    <div class="card-header">
        <div class="row d-flex text-center justify-content-between align-items-center">
            <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
            <h4>Editar técnico</h4>
            <a href="{{url('/assistencia/tecnico')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
        </div>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <form class="col-md-8" action="{{route('tecnico.atualizar',$tecnico->id)}}" method="post"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                @include('assistencia::paginas.tecnicos._form')
                <button class="btn btn-success">Atualizar</button>
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