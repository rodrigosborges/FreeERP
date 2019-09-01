@extends('assistencia::layouts.master')


@section('content')

<div class="card text-center">
    <div class="card-header">
        <h3>Editar peça</h3>
    </div>
    <div class="card-body">
        <div class="row ">
            <div class="col-md-11 text-left">
                <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
                <a href="{{route('pecas.localizar')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
            </div>
        </div>
        <div class="row justify-content-center">
            <form class="col-md-4" action="{{route('pecas.atualizar',$peca->id)}}" method="post"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                @include('assistencia::paginas.estoque._form_pecaEdit')
                <button class="btn btn-success">Atualizar</button>
            </form>
        </div>
    </div>
</div>

@stop
@section('js')
<script>
$(document).ready(function() {
    $('#money1').mask("###0,00", {
        reverse: true
    });
    $('#money2').mask("###0,00", {
        reverse: true
    });
})
</script>
@stop