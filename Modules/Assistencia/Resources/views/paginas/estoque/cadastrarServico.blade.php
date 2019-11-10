@extends('assistencia::layouts.master')


@section('content')
<div class="card text-center">
    <div class="card-header">
        <div class="row d-flex text-center justify-content-between align-items-center">
            <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
            <h4>Novo serviço</h4>
            <a href="{{url('/assistencia/servicos/localizar')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
        </div>
    </div>
    <div class="card-body">
        
        <div class="row justify-content-center">
            <form class="col-md-4" action="{{route('servicos.salvar')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include('assistencia::paginas.estoque._form_serv')
                <button class="btn btn-success">Cadastrar serviço padrão</button>
            </form>
        </div>
    </div>
</div>

@stop
@section('js')
<script>
$(document).ready(function() {
    $('#money2').inputmask('decimal', {
                'alias': 'numeric',
                'groupSeparator': '.',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ",",
                'digitsOptional': false,
                'allowMinus': false,
                'prefix': 'R$ ',
                'placeholder': '',
                'rightAlign':false,
                'max': 9999,
                // 'removeMaskOnSubmit':true
    });
})
</script>
@stop