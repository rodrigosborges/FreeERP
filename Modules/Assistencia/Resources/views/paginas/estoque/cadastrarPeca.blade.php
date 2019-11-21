@extends('assistencia::layouts.master')


@section('css')


@stop

@section('content')

<div class="card text-center">
    <div class="card-header">
        <div class="row d-flex text-center justify-content-between align-items-center">
            <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
            <h4>Nova peça</h4>
            <a href="{{url('/assistencia/estoque/pecas/localizar')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
        </div>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <form class="col-md-4" action="{{route('pecas.salvar')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include('assistencia::paginas.estoque._form_peca')
                <button class="btn btn-success">Cadastrar peça</button>
            </form>
        </div>
    </div>
</div>

@stop
@section('js')
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/bindings/inputmask.binding.min.js"></script>-->
<script src="{{Module::asset('assistencia:js/bibliotecas/inputmask.binding.min.js')}}"></script>

<script>
$(document).ready(function() {
  
    $('#money1').inputmask('decimal', {
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
    $('#qnt').mask('0#');
})
</script>
@stop